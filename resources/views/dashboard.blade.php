<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaClone Feed</title>
    <style>
        :root {
            --bg1: #0a1323;
            --bg2: #121f36;
            --panel: rgba(255,255,255,.08);
            --panel-2: rgba(255,255,255,.12);
            --stroke: rgba(255,255,255,.18);
            --text: #eff4ff;
            --muted: #b7c8e6;
            --accent: #6cdeff;
            --warm: #ffd08c;
            --ok: #b8ffce;
            --danger: #ffc8c8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", "Trebuchet MS", sans-serif;
            color: var(--text);
            background: linear-gradient(140deg, var(--bg1), var(--bg2));
            min-height: 100vh;
        }

        .app {
            max-width: 1280px;
            margin: 0 auto;
            padding: 16px;
            display: grid;
            grid-template-columns: 250px 1fr 280px;
            gap: 16px;
        }

        .glass {
            background: var(--panel);
            border: 1px solid var(--stroke);
            border-radius: 16px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .sidebar,
        .aside {
            position: sticky;
            top: 16px;
            height: fit-content;
            padding: 14px;
        }

        .brand { font-weight: 800; letter-spacing: .3px; margin-bottom: 8px; }
        .me { color: var(--muted); font-size: .9rem; margin-bottom: 10px; }

        .menu a {
            display: block;
            padding: 10px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.13);
            margin-bottom: 8px;
        }

        .menu a.active {
            color: #05334f;
            background: linear-gradient(120deg, var(--accent), #a0efff);
            border: 0;
            font-weight: 700;
        }

        .logout-btn,
        .btn {
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 10px;
            background: var(--panel-2);
            color: var(--text);
            padding: 9px 12px;
            cursor: pointer;
            font-weight: 700;
        }

        .logout-btn { width: 100%; margin-top: 4px; }

        .btn-primary {
            border: 0;
            background: linear-gradient(120deg, var(--accent), #9deefe);
            color: #0a2f45;
            font-weight: 800;
        }

        .btn-sm { padding: 6px 9px; font-size: .8rem; }

        .content { display: grid; gap: 14px; }

        .topbar {
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            font-size: .8rem;
            font-weight: 700;
            color: #5a3900;
            background: linear-gradient(120deg, var(--warm), #ffe6bc);
            padding: 6px 10px;
            border-radius: 999px;
        }

        .notice-ok { color: var(--ok); font-size: .88rem; margin: 0; }
        .notice-error { color: var(--danger); font-size: .88rem; margin: 0; }

        .reels,
        .composer,
        .feed { padding: 12px; }

        .reels h3,
        .composer h3,
        .feed h3,
        .aside h3 { margin: 0 0 10px; font-size: 1rem; }

        .reel-row {
            display: grid;
            grid-template-columns: repeat(8, minmax(88px, 1fr));
            gap: 10px;
            overflow-x: auto;
        }

        .reel-item {
            min-width: 88px;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.16);
            padding: 8px;
        }

        .reel-thumb {
            width: 56px;
            height: 56px;
            margin: 0 auto 6px;
            border-radius: 50%;
            border: 2px solid transparent;
            background: linear-gradient(var(--bg1), var(--bg1)) padding-box,
                        linear-gradient(120deg, #7ee5ff, #ffd08f, #ff8ab4) border-box;
            display: grid;
            place-items: center;
            font-size: .8rem;
            font-weight: 700;
        }

        textarea,
        input[type="file"] {
            width: 100%;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.08);
            color: var(--text);
            padding: 10px;
            font-size: .93rem;
        }

        textarea { min-height: 90px; resize: vertical; margin-bottom: 8px; }

        .post-card {
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.16);
            background: rgba(255,255,255,.06);
            overflow: hidden;
            margin-bottom: 12px;
        }

        .post-head {
            padding: 10px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .post-head a {
            color: #d6ecff;
            text-decoration: none;
            font-weight: 700;
        }

        .post-time { color: var(--muted); font-size: .82rem; }

        .post-media img,
        .post-media video {
            width: 100%;
            max-height: 540px;
            object-fit: cover;
            display: block;
            background: #000;
        }

        .post-body { padding: 10px 12px 12px; }
        .post-caption { color: #d8e6fb; white-space: pre-wrap; font-size: .93rem; margin-bottom: 8px; }

        .action-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .meta { color: var(--muted); font-size: .85rem; }

        .comment-list {
            display: grid;
            gap: 6px;
            margin-bottom: 8px;
        }

        .comment-item {
            border-radius: 9px;
            border: 1px solid rgba(255,255,255,.15);
            background: rgba(255,255,255,.06);
            padding: 7px 9px;
            font-size: .87rem;
            line-height: 1.45;
        }

        .comment-item strong { color: #dcf0ff; }

        .comment-form {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 6px;
        }

        .comment-form input {
            border-radius: 9px;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.08);
            color: var(--text);
            padding: 8px;
        }

        .suggestion {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .suggestion:last-child { border-bottom: 0; }

        .suggestion .name {
            color: #e6f3ff;
            text-decoration: none;
            font-weight: 700;
            font-size: .9rem;
        }

        .suggestion .meta {
            display: block;
            font-size: .8rem;
        }

        .empty {
            color: var(--muted);
            border: 1px dashed rgba(255,255,255,.22);
            border-radius: 12px;
            padding: 14px;
            text-align: center;
        }

        @media (max-width: 1120px) {
            .app { grid-template-columns: 230px 1fr; }
            .aside { grid-column: span 2; position: static; }
        }

        @media (max-width: 840px) {
            .app { grid-template-columns: 1fr; }
            .sidebar,
            .aside { position: static; }
            .reel-row { grid-template-columns: repeat(4, minmax(88px, 1fr)); }
        }
    </style>
</head>
<body>
    <div class="app">
        <aside class="sidebar glass">
            <div class="brand">InstaClone</div>
            <div class="me">{{ auth()->user()->name }}<br>{{ auth()->user()->email }}</div>
            <nav class="menu">
                <a href="{{ route('dashboard') }}" class="active">Home Feed</a>
                <a href="{{ route('reels.index') }}">Reels</a>
                <a href="{{ route('profile.show', auth()->user()) }}">My Profile</a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </aside>

        <main class="content">
            <section class="topbar glass">
                <div>
                    <strong>Welcome, {{ auth()->user()->name }}</strong>
                </div>
                <div class="badge">Full Social MVP</div>
                @if(session('status'))
                    <p class="notice-ok">{{ session('status') }}</p>
                @endif
                @if($errors->any())
                    <p class="notice-error">{{ $errors->first() }}</p>
                @endif
            </section>

            <section class="reels glass">
                <h3>Reels</h3>
                <div class="reel-row">
                    @forelse($reels as $reel)
                        <a href="{{ route('reels.index') }}#reel-{{ $reel->id }}" class="reel-item">
                            <div class="reel-thumb">REEL</div>
                            <div>{{ \Illuminate\Support\Str::limit($reel->user->name, 9) }}</div>
                        </a>
                    @empty
                        <div class="reel-item">
                            <div class="reel-thumb">NEW</div>
                            <div>Upload first reel</div>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="composer glass">
                <h3>Create Post / Reel</h3>
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <textarea name="caption" placeholder="Write a caption...">{{ old('caption') }}</textarea>
                    <input type="file" name="media" accept="image/*,video/*" required>
                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
            </section>

            <section class="feed glass">
                <h3>Feed</h3>
                @forelse($posts as $post)
                    <article class="post-card">
                        <div class="post-head">
                            <a href="{{ route('profile.show', $post->user) }}">{{ $post->user->name }}</a>
                            <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
                        </div>

                        <div class="post-media">
                            @if($post->media_type === 'video')
                                <video controls preload="metadata">
                                    <source src="{{ asset('storage/' . $post->media_path) }}">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $post->media_path) }}" alt="Post media">
                            @endif
                        </div>

                        <div class="post-body">
                            @if($post->caption)
                                <div class="post-caption">{{ $post->caption }}</div>
                            @endif

                            @php($liked = $post->likes->contains('user_id', auth()->id()))
                            <div class="action-row">
                                <form method="POST" action="{{ route('posts.like', $post) }}">
                                    @csrf
                                    <button class="btn btn-sm" type="submit">{{ $liked ? 'Unlike' : 'Like' }}</button>
                                </form>
                                <span class="meta">{{ $post->likes->count() }} likes</span>
                                <span class="meta">{{ $post->comments->count() }} comments</span>
                            </div>

                            <div class="comment-list">
                                @foreach($post->comments->take(3) as $comment)
                                    <div class="comment-item"><strong>{{ $comment->user->name }}</strong> {{ $comment->body }}</div>
                                @endforeach
                            </div>

                            <form method="POST" action="{{ route('posts.comment', $post) }}" class="comment-form">
                                @csrf
                                <input type="text" name="body" placeholder="Add a comment..." maxlength="500" required>
                                <button class="btn btn-sm" type="submit">Post</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="empty">No posts yet. Upload your first photo or reel.</div>
                @endforelse
            </section>
        </main>

        <aside class="aside glass">
            <h3>Suggested Users</h3>
            @forelse($suggestedUsers as $suggested)
                <div class="suggestion">
                    <div>
                        <a class="name" href="{{ route('profile.show', $suggested) }}">{{ $suggested->name }}</a>
                        <span class="meta">{{ $suggested->followers_count }} followers | {{ $suggested->posts_count }} posts</span>
                    </div>
                    <form method="POST" action="{{ route('users.follow', $suggested) }}">
                        @csrf
                        <button class="btn btn-sm" type="submit">{{ in_array($suggested->id, $followingIds) ? 'Unfollow' : 'Follow' }}</button>
                    </form>
                </div>
            @empty
                <div class="empty">No user suggestions available.</div>
            @endforelse
        </aside>
    </div>
</body>
</html>