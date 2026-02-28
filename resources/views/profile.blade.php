<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profileUser->name }} Profile</title>
    <style>
        :root {
            --bg: #0b1629;
            --panel: rgba(255,255,255,.08);
            --stroke: rgba(255,255,255,.2);
            --text: #ebf4ff;
            --muted: #b6c8e6;
            --accent: #6edfff;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", "Trebuchet MS", sans-serif;
            background: linear-gradient(155deg, #091325, #14243e);
            color: var(--text);
            min-height: 100vh;
            padding: 16px;
        }

        .wrap { max-width: 980px; margin: 0 auto; display: grid; gap: 12px; }
        .glass {
            border-radius: 14px;
            background: var(--panel);
            border: 1px solid var(--stroke);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .head {
            padding: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .meta { color: var(--muted); font-size: .9rem; }
        .counts { display: flex; gap: 12px; margin-top: 6px; color: var(--muted); }
        .counts b { color: #f2f8ff; }

        .btn {
            border: 0;
            border-radius: 10px;
            padding: 8px 12px;
            cursor: pointer;
            background: linear-gradient(120deg, var(--accent), #a4efff);
            color: #08344f;
            font-weight: 800;
        }

        .btn-link {
            text-decoration: none;
            color: #d6edff;
            font-weight: 700;
            margin-left: 8px;
        }

        .posts {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            padding: 12px;
        }

        .post-card {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.18);
            background: rgba(255,255,255,.05);
        }

        .post-card img,
        .post-card video {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            background: #000;
        }

        .caption {
            padding: 8px;
            font-size: .84rem;
            color: #d2e4fb;
            min-height: 44px;
        }

        .empty {
            margin: 12px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed rgba(255,255,255,.25);
            border-radius: 10px;
            padding: 16px;
        }

        @media (max-width: 860px) {
            .posts { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 560px) {
            .posts { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="head glass">
            <div>
                <h2 style="margin:0;">{{ $profileUser->name }}</h2>
                <div class="meta">{{ $profileUser->email }}</div>
                <div class="counts">
                    <div><b>{{ $profileUser->posts->count() }}</b> posts</div>
                    <div><b>{{ $followersCount }}</b> followers</div>
                    <div><b>{{ $followingCount }}</b> following</div>
                </div>
            </div>
            <div>
                @if(auth()->id() !== $profileUser->id)
                    <form method="POST" action="{{ route('users.follow', $profileUser) }}" style="display:inline;">
                        @csrf
                        <button class="btn" type="submit">{{ $isFollowing ? 'Unfollow' : 'Follow' }}</button>
                    </form>
                @endif
                <a class="btn-link" href="{{ route('dashboard') }}">Back to feed</a>
            </div>
        </section>

        <section class="glass">
            <div class="posts">
                @forelse($profileUser->posts as $post)
                    <article class="post-card">
                        @if($post->media_type === 'video')
                            <video controls preload="metadata">
                                <source src="{{ asset('storage/' . $post->media_path) }}">
                            </video>
                        @else
                            <img src="{{ asset('storage/' . $post->media_path) }}" alt="Profile post">
                        @endif
                        <div class="caption">{{ \Illuminate\Support\Str::limit($post->caption ?: 'No caption', 90) }}</div>
                    </article>
                @empty
                    <div class="empty">No posts yet.</div>
                @endforelse
            </div>
        </section>
    </div>
</body>
</html>
