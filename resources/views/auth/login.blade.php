
<link rel="stylesheet" href="/css/style.css">

<div style="max-width:420px;margin:80px auto;padding:24px;border-radius:10px;background:#fff;border:1px solid #e9e9e9;">
    <h2 style="margin-bottom:14px;text-align:center">Login</h2>

    @if(session('success'))
    <div style="background:#e6ffed;border:1px solid #b6f2c8;padding:8px;border-radius:6px;margin-bottom:12px;color:#11632a;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div style="background:#fff3f3;border:1px solid #f1c2c2;padding:8px;border-radius:6px;margin-bottom:12px;color:#a33;">{{ session('error') }}</div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div style="margin-bottom:10px">
            <label>Email</label>
            <input type="email" name="email" required style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px">
        </div>
        <div style="margin-bottom:12px">
            <label>Password</label>
            <input type="password" name="password" required style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px">
        </div>
        <div style="display:flex;gap:8px">
            <button type="submit" style="background:#00c6ff;color:#000;border:0;padding:8px 12px;border-radius:6px;font-weight:700">Login</button>
            <a href="/user" style="display:inline-block;padding:8px 12px;border-radius:6px;border:1px solid #e6e6e6;text-decoration:none;color:#333">Browse</a>
        </div>
    </form>
    <div>
    <p>NOTE: ada 2 tipe akun</p>
    <div style="margin-top:12px;color:#666;font-size:13px">
    <li>
        admin (admin@example.com / password)        
    </li>
    <li>
         user (test@example.com / password)
    </li>
    </div>
</div>

