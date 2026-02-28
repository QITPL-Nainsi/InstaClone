<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root {
            --bg-1: #241135;
            --bg-2: #3f1f5e;
            --bg-3: #63295f;
            --glass: rgba(255, 255, 255, 0.1);
            --stroke: rgba(255, 255, 255, 0.23);
            --text: #fff7ef;
            --muted: #eedaf8;
            --accent: #ffd47f;
            --accent-2: #ff8f7a;
            --danger: #ffd5d5;
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
            background: linear-gradient(-45deg, var(--bg-1), var(--bg-2), var(--bg-3), #3e1954);
            background-size: 280% 280%;
            animation: bgPulse 14s ease infinite;
            overflow: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            z-index: 0;
            filter: blur(20px);
            opacity: .5;
        }

        body::before {
            width: 44vmax;
            height: 44vmax;
            top: -18vmax;
            left: -12vmax;
            background: radial-gradient(circle, #ffd58a 0%, transparent 62%);
            animation: driftA 15s ease-in-out infinite;
        }

        body::after {
            width: 42vmax;
            height: 42vmax;
            right: -14vmax;
            bottom: -16vmax;
            background: radial-gradient(circle, #ff8c80 0%, transparent 62%);
            animation: driftB 17s ease-in-out infinite;
        }

        .sparkles {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .sparkles i {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .45);
            animation: sparkle linear infinite;
        }

        .sparkles i:nth-child(1) { left: 7%; animation-duration: 11s; animation-delay: -1s; }
        .sparkles i:nth-child(2) { left: 19%; animation-duration: 14s; animation-delay: -3s; }
        .sparkles i:nth-child(3) { left: 33%; animation-duration: 12s; animation-delay: -9s; }
        .sparkles i:nth-child(4) { left: 47%; animation-duration: 15s; animation-delay: -5s; }
        .sparkles i:nth-child(5) { left: 61%; animation-duration: 13s; animation-delay: -7s; }
        .sparkles i:nth-child(6) { left: 76%; animation-duration: 16s; animation-delay: -2s; }
        .sparkles i:nth-child(7) { left: 89%; animation-duration: 10s; animation-delay: -4s; }

        .card {
            position: relative;
            z-index: 2;
            width: min(520px, 100%);
            border-radius: 24px;
            padding: 40px 34px 32px;
            background: var(--glass);
            border: 1px solid var(--stroke);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 26px 70px rgba(15, 4, 26, .55);
            animation: lift .55s ease;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
            letter-spacing: .3px;
        }

        .sub {
            margin: 10px 0 24px;
            color: var(--muted);
            line-height: 1.58;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            font-size: .92rem;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            height: 48px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .28);
            background: rgba(255, 255, 255, .1);
            color: #fff;
            padding: 0 14px;
            font-size: .95rem;
            outline: none;
            transition: .2s ease;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(255, 212, 127, .24);
            background: rgba(255, 255, 255, .14);
        }

        .remember {
            margin-top: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: .92rem;
        }

        .remember input { width: 15px; height: 15px; }

        .error {
            margin-top: 7px;
            color: var(--danger);
            font-size: .84rem;
        }

        button {
            margin-top: 20px;
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: .3px;
            color: #3a1f50;
            cursor: pointer;
            background: linear-gradient(115deg, var(--accent), #ffe5b5);
            box-shadow: 0 12px 30px rgba(255, 212, 127, .32);
            transition: transform .17s ease;
        }

        button:hover { transform: translateY(-2px); }

        .alt {
            margin-top: 16px;
            text-align: center;
            color: var(--muted);
            font-size: .94rem;
        }

        .alt a {
            color: var(--accent-2);
            text-decoration: none;
            font-weight: 700;
        }

        @keyframes bgPulse {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes driftA {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(8vmax, 7vmax); }
        }

        @keyframes driftB {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-8vmax, -8vmax); }
        }

        @keyframes sparkle {
            0% { transform: translateY(100vh) scale(.75); opacity: 0; }
            15% { opacity: .55; }
            100% { transform: translateY(-12vh) scale(1.15); opacity: 0; }
        }

        @keyframes lift {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="sparkles">
        <i></i><i></i><i></i><i></i><i></i><i></i><i></i>
    </div>

    <section class="card">
        <h1>Welcome Back</h1>
        <p class="sub">Login karke dashboard access karo. Session secure hai aur experience ab full cinematic glass style me hai.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<p class="error">{{ $message }}</p>@enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')<p class="error">{{ $message }}</p>@enderror

            <label class="remember" for="remember">
                <input id="remember" type="checkbox" name="remember" value="1">
                Remember me
            </label>

            <button type="submit">Login Now</button>
        </form>
        <p class="alt">New here? <a href="{{ route('register') }}">Create account</a></p>
    </section>
</body>
</html>