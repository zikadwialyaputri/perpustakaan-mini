<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="{{ asset('asset-admin/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-4">Login</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>

                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
