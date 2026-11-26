<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>410 Gone · The Rigid Boxes</title>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.png') }}" type="image/png">
    <style>
        body { margin: 0; font-family: 'DM Sans', system-ui, -apple-system, sans-serif; background: #f8f5f5; color: #252329; min-height: 100vh; display: grid; place-items: center; padding: 24px; }
        .box { max-width: 520px; width: 100%; background: #fff; border: 1px solid #ebe8ec; border-radius: 16px; padding: 40px 32px; text-align: center; box-shadow: 0 12px 35px rgba(42, 25, 31, .08); }
        .code { display: inline-block; padding: 6px 14px; border-radius: 99px; background: #f8eeec; color: #8d4445; font-weight: 800; font-size: 13px; letter-spacing: .06em; margin-bottom: 14px; }
        h1 { margin: 0 0 10px; font-size: 26px; }
        p { margin: 0 0 24px; color: #6d6873; line-height: 1.6; font-size: 15px; }
        a.btn { display: inline-block; padding: 12px 22px; border-radius: 9px; background: #8d4445; color: #fff; text-decoration: none; font-weight: 700; }
        a.btn:hover { background: #633032; }
    </style>
</head>
<body>
    <div class="box">
        <div class="code">410 GONE</div>
        <h1>This page is no longer available</h1>
        <p>The URL you requested has been permanently removed. Please return to our homepage or browse our custom rigid boxes.</p>
        <a class="btn" href="{{ url('/') }}">Back to Homepage</a>
    </div>
</body>
</html>
