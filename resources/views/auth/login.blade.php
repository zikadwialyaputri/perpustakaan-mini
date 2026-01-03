<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Kata Aksara</title>

    {{-- CSS Utama --}}
    <link href="{{ asset('asset-admin/css/app.css') }}" rel="stylesheet">

    {{-- CSS Login Khusus --}}
    <style>
        body {
            background: linear-gradient(135deg, #f4f6fb, #e9eef5);
        }

        /* Wrapper tengah */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card */
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 14px;
            animation: fadeSlideUp 0.8s ease forwards;
            opacity: 0;
        }

        /* Logo */
        .login-logo {
            max-width: 120px;
            animation: fadeIn 1s ease forwards;
        }

        /* Animations */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Button */
        .btn-primary {
            padding: 10px;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="card shadow login-card">
        <div class="card-body p-4">

            {{-- LOGO --}}
            <div class="text-center mb-3">
                <img src="{{ asset('asset-admin/img/logo-kata-aksara.jpg') }}"
                     alt="Kata Aksara"
                     class="login-logo">
            </div>

            <h4 class="text-center mb-4 fw-bold">Login</h4>

            {{-- FORM LOGIN --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="contoh@email.com"
                           required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="••••••••"
                           required>
                </div>

                <button class="btn btn-primary w-100 mt-2">
                    Login
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        Lanjutkan sebagai tamu
                    </a>
                </div>
            </form>

            {{-- ERROR --}}
            @error('email')
                <div class="text-danger text-center mt-3">
                    {{ $message }}
                </div>
            @enderror

        </div>
    </div>
</div>

</body>
</html>
