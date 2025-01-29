@extends('layouts.guest')
@section('content')
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
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                    <x-text-input id="password" class="form-control" type="password"
                                    name="password" required autocomplete="current-password" />
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me"
                                            unchecked="">
                                        <label class="form-check-label" for="remember_me">Remember me</label>
                                    </div>
                                    <div>
                                        {!! htmlFormSnippet() !!}
                                        @error('g-recaptcha-response')
                                        <div>
                                            <small style="color: red">
                                                Captcha tidak boleh kosong.
                                            </small>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                            in</button>
                                    </div>
                                </form>
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
@endsection
