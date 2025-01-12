<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="NextDigit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>| পঞ্চহাব - লগইন |</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/my-login.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/favicon.ico') }}' />
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Admin Login</h4>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="text-danger font-medium">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login') }}" class="my-login-validation"
                                novalidate="">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autofocus autofocus
                                        autocomplete="username" />
                                    @error('email')
                                        <div class="text-danger font-medium">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>
                                <!-- Forgot Password -->
                                <div class="form-group">
                                    <label for="password">Password
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('admin.password.request') }}" class="float-right">
                                                Forgot Password?
                                            </a>
                                        @endif
                                    </label>
                                    <!-- Password -->
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" required autocomplete="current-password"
                                        data-eye />
                                    @error('password')
                                        <div class="text-danger font-medium">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <!-- Remember Me -->
                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember"
                                            class="custom-control-input">
                                        <label for="remember" class="custom-control-label">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    Don't have an account? <a href="{{ route('admin.register') }}">Create One</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2025 &mdash; <a href="https://www.facebook.com/NextDigitOfficial/"
                            target="_blank">Next Digit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/my-login.js') }}"></script>

    <!-- Scripts -->
    @isset($script)
        {{ $script }}
    @endisset -->

</body>

</html>
