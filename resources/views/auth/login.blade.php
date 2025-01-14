{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
<div>
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus autocomplete="username" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="current-password" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Remember Me -->
<div class="block mt-4">
    <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
    </label>
</div>
<div>
    {!! htmlFormSnippet() !!}
    @error('g-recaptcha-response')
    <div>
        <small style="color: red">
            @if($message == 'The g-recaptcha-response field is required.')
            Captcha tidak boleh kosong.
            @else
            $message
            @endif
        </small>
    </div>
    @enderror
</div>
<div class="flex items-center justify-end mt-4">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
    </a>
    @endif

    <x-primary-button class="ms-3">
        {{ __('Log in') }}
    </x-primary-button>
</div>
</form>
</x-guest-layout> --}}


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="apple-touch-icon" sizes="76x76" href={{asset('auth/img/logo_lldikti_iv.jpg')}}>
    <link rel="icon" type="image/png" href={{asset('auth/img/logo_lldikti_iv.jpg')}}>
    <title>SENAD4 LLDIKTI IV</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href={{asset('auth/css/nucleo-icons.css')}} rel="stylesheet" />
    <link href={{asset('auth/css/nucleo-svg.css')}} rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    {!!htmlScriptTagJsApi()!!}
</head>
    <link id="pagestyle" href={{asset('auth/css/soft-ui-dashboard.css?v=1.0.3')}} rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100 ">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav
                    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 blur blur-rounded shadow py-2 start-0 end-0 mx4">
                    <div class="container-fluid container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 ">
                            Aplikasi Data Kerjasama LLDIKTI Wilayah IV
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">SENAD4 IV</h3>
                                </div>
                                <div class="card-body">

                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" required autofocus autocomplete="username" />

                                            {{-- <input class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                                placeholder="Email" aria-label="Email"> --}}
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                        <x-text-input id="password" class="form-control" type="password"
                                        name="password" required autocomplete="current-password" />
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe"
                                                unchecked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div>
                                            {!! htmlFormSnippet() !!}
                                            @error('g-recaptcha-response')
                                            <div>
                                                <small style="color: red">
                                                    @if($message == 'The g-recaptcha-response field is required.')
                                                    Captcha tidak boleh kosong.
                                                    @else
                                                    $message
                                                    @endif
                                                </small>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                    {{-- <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                name="remember">
                                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div>
                                        {!! htmlFormSnippet() !!}
                                        @error('g-recaptcha-response')
                                        <div>
                                            <small style="color: red">
                                                @if($message == 'The g-recaptcha-response field is required.')
                                                Captcha tidak boleh kosong.
                                                @else
                                                $message
                                                @endif
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                        @endif

                                        <x-primary-button class="ms-3">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                    </div>
                                    </form> --}}
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="register" class="text-info text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100"
                                    style="background-image:url({{asset('../auth/img/buldingfront.jpg')}}); top: 0px; left: -500px; background-size: cover; z-index: 0;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="auth/js/core/popper.min.js"></script>
    <script src="auth/js/core/bootstrap.min.js"></script>
    <script src="auth/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="auth/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="auth/js/plugins/fullcalendar.min.js"></script>
    <script src="auth/js/plugins/chartjs.min.js"></script>


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="auth/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
