<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        :root {
            --bg-1: #091428;
            --bg-2: #0f2746;
            --bg-3: #1b3d6a;
            --glass: rgba(255, 255, 255, 0.1);
            --glass-strong: rgba(255, 255, 255, 0.18);
            --stroke: rgba(255, 255, 255, 0.24);
            --text: #f3f8ff;
            --muted: #c4d7ef;
            --accent: #61dcff;
            --accent-2: #ffd08a;
            --danger: #ff9d9d;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            font-family: "Segoe UI", "Trebuchet MS", sans-serif;
            color: var(--text);
            background: linear-gradient(-45deg, var(--bg-1), var(--bg-2), var(--bg-3), #0f3159);
            background-size: 300% 300%;
            animation: bgShift 16s ease infinite;
            overflow: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 46vmax;
            height: 46vmax;
            border-radius: 50%;
            filter: blur(18px);
            z-index: 0;
            opacity: 0.45;
        }

        body::before {
            background: radial-gradient(circle, #5cd9ff 0%, transparent 62%);
            top: -18vmax;
            left: -14vmax;
            animation: orbA 15s ease-in-out infinite;
        }

        body::after {
            background: radial-gradient(circle, #ffcc78 0%, transparent 62%);
            right: -16vmax;
            bottom: -20vmax;
            animation: orbB 18s ease-in-out infinite;
        }

        .particles {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .particles span {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.35);
            animation: floatUp linear infinite;
        }

        .particles span:nth-child(1) { left: 8%; animation-duration: 12s; animation-delay: -2s; }
        .particles span:nth-child(2) { left: 21%; animation-duration: 16s; animation-delay: -8s; }
        .particles span:nth-child(3) { left: 35%; animation-duration: 13s; animation-delay: -3s; }
        .particles span:nth-child(4) { left: 48%; animation-duration: 18s; animation-delay: -11s; }
        .particles span:nth-child(5) { left: 63%; animation-duration: 14s; animation-delay: -5s; }
        .particles span:nth-child(6) { left: 78%; animation-duration: 17s; animation-delay: -1s; }
        .particles span:nth-child(7) { left: 90%; animation-duration: 15s; animation-delay: -9s; }

        .panel {
            position: relative;
            z-index: 2;
            width: min(950px, 100%);
            display: grid;
            grid-template-columns: 1fr 1.08fr;
            border-radius: 26px;
            overflow: hidden;
            background: var(--glass);
            border: 1px solid var(--stroke);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 28px 80px rgba(3, 12, 28, 0.55);
            animation: riseIn .6s ease;
        }

        .hero {
            padding: 50px 42px;
            background: linear-gradient(160deg, rgba(255,255,255,.16), rgba(255,255,255,.05));
        }

        .hero h1 {
            margin: 0 0 12px;
            font-size: clamp(1.9rem, 2vw, 2.6rem);
            letter-spacing: .3px;
            line-height: 1.2;
        }

        .hero p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .tags {
            margin-top: 26px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tags span {
            border-radius: 999px;
            padding: 7px 12px;
            font-size: .82rem;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .form-wrap {
            padding: 42px;
            background: linear-gradient(170deg, rgba(10, 23, 44, .48), rgba(11, 20, 36, .38));
        }

        .form-wrap h2 {
            margin: 0 0 22px;
            font-size: 1.55rem;
        }

        label {
            display: block;
            margin: 14px 0 7px;
            font-size: .92rem;
            font-weight: 600;
            color: #d7e7fb;
        }

        input {
            width: 100%;
            height: 48px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .26);
            background: rgba(255, 255, 255, .09);
            color: #fff;
            padding: 0 14px;
            font-size: .95rem;
            outline: none;
            transition: .2s ease;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(97, 220, 255, .23);
            background: rgba(255, 255, 255, .13);
        }

        .error {
            color: var(--danger);
            font-size: .82rem;
            margin: 6px 0 0;
        }

        .btn {
            margin-top: 22px;
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 12px;
            cursor: pointer;
            color: #09324d;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: .3px;
            background: linear-gradient(100deg, var(--accent), #99ecff);
            box-shadow: 0 14px 30px rgba(97, 220, 255, .28);
            transition: transform .18s ease;
        }

        .btn:hover { transform: translateY(-2px); }

        .link {
            margin-top: 16px;
            text-align: center;
            color: var(--muted);
            font-size: .94rem;
        }

        .link a {
            color: var(--accent-2);
            text-decoration: none;
            font-weight: 700;
        }

        @keyframes bgShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes orbA {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(6vmax, 7vmax); }
        }

        @keyframes orbB {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-8vmax, -6vmax); }
        }

        @keyframes floatUp {
            0% { transform: translateY(100vh) scale(.7); opacity: 0; }
            15% { opacity: .5; }
            100% { transform: translateY(-12vh) scale(1.1); opacity: 0; }
        }

        @keyframes riseIn {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 860px) {
            .panel { grid-template-columns: 1fr; }
            .hero { padding: 34px 26px; }
            .form-wrap { padding: 30px 24px; }
        }
    </style>
</head>
<body>
    <div class="particles">
        <span></span><span></span><span></span><span></span><span></span><span></span><span></span>
    </div>

    <section class="panel">
        <aside class="hero">
            <h1>Build Something Worth Remembering</h1>
            <p>Account banao, login karo, aur apna personalized dashboard unlock karo. Fast, clean, secure, and beautiful.</p>
            <div class="tags">
                <span>Zero friction</span>
                <span>Strong security</span>
                <span>Premium feel</span>
            </div>
        </aside>

        <div class="form-wrap">
            <h2>Create Your Account</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')<p class="error">{{ $message }}</p>@enderror

                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<p class="error">{{ $message }}</p>@enderror

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')<p class="error">{{ $message }}</p>@enderror

                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>

                <button class="btn" type="submit">Create Account</button>
            </form>
            <p class="link">Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </section>
</body>
</html>