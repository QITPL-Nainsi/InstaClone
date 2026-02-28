<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reels</title>
    <style>
        :root {
            --bg: #080f1b;
            --panel: rgba(255,255,255,.08);
            --stroke: rgba(255,255,255,.18);
            --text: #edf4ff;
            --muted: #b6c8e4;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", "Trebuchet MS", sans-serif;
            background: linear-gradient(160deg, #091428, #141f34);
            color: var(--text);
            min-height: 100vh;
            padding: 16px;
        }

        .wrap { max-width: 820px; margin: 0 auto; display: grid; gap: 12px; }
        .card {
            border-radius: 14px;
            background: var(--panel);
            border: 1px solid var(--stroke);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .top {
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
        }

        a {
            color: #d8efff;
            text-decoration: none;
            font-weight: 700;
        }

        .meta { color: var(--muted); font-size: .85rem; }
        video { width: 100%; display: block; max-height: 80vh; background: #000; }
        .empty {
            padding: 22px;
            text-align: center;
            color: var(--muted);
            border: 1px dashed rgba(255,255,255,.2);
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card top">
            <div><strong>Reels</strong> <span class="meta">Vertical video stream</span></div>
            <a href="{{ route('dashboard') }}">Back to feed</a>
        </div>

        @forelse($reels as $reel)
            <article class="card" id="reel-{{ $reel->id }}">
                <div class="top">
                    <a href="{{ route('profile.show', $reel->user) }}">{{ $reel->user->name }}</a>
                    <span class="meta">{{ $reel->created_at->diffForHumans() }} | {{ $reel->likes->count() }} likes</span>
                </div>
                <video controls preload="metadata">
                    <source src="{{ asset('storage/' . $reel->media_path) }}">
                </video>
            </article>
        @empty
            <div class="empty">No reels available yet. Upload a video from dashboard.</div>
        @endforelse
    </div>
</body>
</html>
