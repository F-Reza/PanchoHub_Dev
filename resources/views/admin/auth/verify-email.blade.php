<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="NextDigit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>| পঞ্চহাব - ভেরিফাই ইমেইল |</title>
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
                            <h4 class="card-title">Verification Email</h4>

                            <form method="POST" action="{{ route('admin.verification.send') }}"
                                class="my-login-validation" novalidate="">
                                @csrf

                                <div class="form-group">
                                    <div class="form-text text-muted">
                                        Thanks for signing up! Before getting started, could you verify your email
                                        address by clicking on the link we just emailed to you? If you didn't receive
                                        the email, we will gladly send you another.
                                    </div>
                                </div>

                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 text-success font-medium">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Resend Verification Email
                                    </button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="mt-4 btn btn-link text-primary text-center w-100 text-decoration-none">
                                    Log Out
                                </button>
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
