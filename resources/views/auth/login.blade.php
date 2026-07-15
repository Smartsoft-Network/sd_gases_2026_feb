<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}: Sign in</title>
        <link rel="shortcut icon" href="{{ asset('images/sdgases-logo.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="login-root">
            <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
                <div class="loginbackground box-background--white padding-top--64">
                    <div class="loginbackground-gridContainer">
                        <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
                            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
                            </div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
                            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
                            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
                            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
                            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
                            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
                            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
                            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
                        </div>
                        <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
                            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
                        </div>
                    </div>
                </div>
                <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                    <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
                        <h1></h1>
                    </div>
                    <div style="padding-top: 14px;">
                        <div class="formbg">
                            <div class="formbg-inner padding-horizontal--48">
                                <span class="padding-bottom--15">Sign in to your account</span>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="field padding-bottom--24">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <div class="grid--50-50">
                                            <label for="password">Password</label>
                                            <div class="reset-pass">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="password" id="password" name="password" required autocomplete="current-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                                        <label for="remember_me">
                                            <input type="checkbox" id="remember_me" name="remember"> Stay signed in
                                        </label>
                                    </div>
                                    <div class="field padding-bottom--24">
                                        <input type="submit" name="submit" value="Continue">
                                    </div>
                                    <div class="field">
                                        {{-- <a class="ssolink" href="#">Use single sign-on (Google) instead</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer-link padding-top--24">
                            {{-- <span>Don't have an account? <a href="">Sign up</a></span> --}}
                            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
                                <span><a href="{{ url('/') }}">© {{ config('app.name', 'Laravel') }}</a></span>
                                {{-- <span><a href="#">Contact</a></span> --}}
                                {{-- <span><a href="#">Privacy & terms</a></span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
