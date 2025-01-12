<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="NextDigit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>| পঞ্চহাব - রিসেট পাসওয়ার্ড |</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/my-login.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/favicon.ico') }}' />
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Reset Password</h4>

                            <form method="POST" action="{{ route('admin.password.store') }}"
                                class="my-login-validation" novalidate="">
                                @csrf

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">


                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email', $request->email) }}" required autofocus autofocus
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

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="new-password" data-eye />
                                    @error('password')
                                        <div class="text-danger font-medium">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}" required
                                        autocomplete="new-password" data-eye />
                                    @error('password_confirmation')
                                        <div class="text-danger font-medium">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Confirm Password is required
                                    </div>
                                    <div class="form-text text-muted">
                                        Make sure your password is strong and easy to remember
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Reset Password
                                    </button>
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
