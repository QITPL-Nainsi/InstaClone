<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'likes', 'comments.user'])->latest()->get();
        $user = Auth::user();

        $suggestedUsers = User::where('id', '!=', $user->id)
            ->withCount(['followers', 'posts'])
            ->latest()
            ->take(5)
            ->get();

        $followingIds = $user->following()->pluck('users.id')->all();

        return view('dashboard', [
            'posts' => $posts,
            'reels' => $posts->where('media_type', 'video')->take(10),
            'suggestedUsers' => $suggestedUsers,
            'followingIds' => $followingIds,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:2200'],
            'media' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm', 'max:20480'],
        ]);

        $file = $validated['media'];
        $mimeType = $file->getMimeType();
        $mediaType = strpos($mimeType, 'video/') === 0 ? 'video' : 'image';
        $path = $file->store('posts', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'caption' => $validated['caption'] ?? null,
            'media_path' => $path,
            'media_type' => $mediaType,
        ]);

        return redirect()->route('dashboard')->with('status', 'Post uploaded successfully.');
    }

    public function reels()
    {
        $reels = Post::with(['user', 'likes'])
            ->where('media_type', 'video')
            ->latest()
            ->get();

        return view('reels', ['reels' => $reels]);
    }

    public function profile(User $user)
    {
        $user->load([
            'posts' => function ($query) {
                $query->latest()->with(['likes', 'comments.user']);
            },
            'followers',
            'following',
        ]);

        return view('profile', [
            'profileUser' => $user,
            'isFollowing' => Auth::id() !== $user->id && Auth::user()->following()->where('following_id', $user->id)->exists(),
            'followersCount' => $user->followers->count(),
            'followingCount' => $user->following->count(),
        ]);
    }

    public function toggleLike(Post $post)
    {
        $existing = $post->likes()->where('user_id', Auth::id())->first();

        if ($existing) {
            $existing->delete();
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);
        }

        return back();
    }

    public function storeComment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:500'],
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'body' => $validated['body'],
        ]);

        return back();
    }

    public function toggleFollow(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->id === $user->id) {
            return back()->with('status', 'You cannot follow yourself.');
        }

        $alreadyFollowing = $authUser->following()->where('following_id', $user->id)->exists();

        if ($alreadyFollowing) {
            $authUser->following()->detach($user->id);
            return back()->with('status', 'User unfollowed.');
        }

        $authUser->following()->attach($user->id);

        return back()->with('status', 'User followed.');
    }
}
