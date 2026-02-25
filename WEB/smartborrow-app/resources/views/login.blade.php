<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NonaPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card-login { 
            border: none; 
            border-radius: 25px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            background: white;
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .btn-pastel { 
            background: #ff758c; 
            color: white; 
            border: none; 
            border-radius: 12px; 
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-pastel:hover { background: #ff5e78; transform: scale(1.02); }
        .form-control { border-radius: 10px; border: 1px solid #fecfef; }
        .lang-switcher a { text-decoration: none; font-size: 0.8rem; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card-login">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #ff758c;">{{ __('messages.welcome') }}</h2>
            <p class="text-muted">{{ __('messages.subtitle') }}</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger small py-2">{{ session('error') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email</label>
                <input type="email" name="email" class="form-control p-2" placeholder="admin@gmail.com" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control p-2" placeholder="••••••" required>
            </div>

            <button type="submit" class="btn btn-pastel w-100 py-2 mb-3">
                {{ __('messages.login_btn') }}
            </button>

            <div class="text-center mt-3">
                <p style="color: #ad1457; margin-bottom: 8px;">{{ __('messages.no_account') }}</p>
                <a href="{{ route('register') }}" class="btn btn-outline-danger w-100">
                    {{ __('messages.register_btn') }}
                </a>
            </div>
        </form>

        <div class="lang-switcher text-center mt-4 pt-3 border-top">
            <a href="?lang=id" class="{{ app()->getLocale() == 'id' ? 'text-danger' : 'text-muted' }}">ID</a>
            <span class="text-muted mx-2">|</span>
            <a href="?lang=en" class="{{ app()->getLocale() == 'en' ? 'text-danger' : 'text-muted' }}">EN</a>
        </div>
    </div>

</body>
</html>