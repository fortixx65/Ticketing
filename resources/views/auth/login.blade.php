@extends('layout')

@section('title', 'test')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <div class="card card-raised shadow-10 mt-5 mt-xl-10 mb-4">
                <div class="card-body p-5">
                    <!-- Auth header with logo image-->
                    <div class="text-center">
                        <h1 class="display-5 mb-0">Se connecter</h1>
                        <div class="subheading-1 mb-5">to continue to app</div>
                    </div>
                    {{-- <!-- Login submission form-->
                    <form>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Username" outlined=""></mwc-textfield></div>
                        <div class="mb-4"><mwc-textfield class="w-100" label="Password" outlined="" icontrailing="visibility_off" type="password"></mwc-textfield></div>
                        <div class="d-flex align-items-center">
                            <mwc-formfield label="Remember password"><mwc-checkbox></mwc-checkbox></mwc-formfield>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small fw-500 text-decoration-none" href="app-auth-password-basic.html">Forgot Password?</a>
                            <a class="btn btn-primary" href="index.html">Login</a>
                        </div>
                    </form> --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                
                        <!-- Email Address -->
                        <div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" type="email" placeholder="email" value=""required>
                                <label for="floatingInput">Email</label>
                            </div>
                            {{-- <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                        </div>
                
                        <!-- Password -->
                        <div class="mt-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="password" type="password" placeholder="Mot de passe" value=""required>
                                <label for="floatingInput">Mot de passe</label>
                            </div>
                            {{-- <x-input-label for="password" :value="__('Password')" />
                
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                
                            <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                        </div>
                
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">Rester connecter</span>
                            </label>
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    Mot de passe oublier
                                </a>
                            @endif
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Auth card message-->
            <div class="text-center mb-5"><a class="small fw-500 text-decoration-none link-white" href="app-auth-register-basic.html">Need an account? Sign up!</a></div>
        </div>
    </div>
</div>

@endsection