@extends('layout.auth')
@pushOnce('head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endPushOnce
@section('form')
    <div class="flex flex-col items-center justify-center w-full h-full" data-role="page-login">
        <div class="flex flex-col items-center w-full py-40 justify-cente">
            <h1 class="mb-16 text-6xl font-bold">
                Login
            </h1>

            <div data-role="login-container" class="w-full max-w-md px-10">

                {{-- Login Form --}}
                <form action="{{ route('doLogin') }}" method="POST" class="flex flex-col gap-10">
                    @csrf
                    <div class="flex flex-col gap-6">
                        <x-form.text placeholder="email" icon="fas-user" name="email" value="{{ old('email') }}"
                            autofocus required></x-form.text>
                        <x-form.password placeholder="password" name="password" icon="fas-lock" required></x-form.password>
                    </div>


                    <div data-role="action-message" class="flex flex-col gap-2">
                        @if ($errors->any())
                            <p class="ml-4 text-sm font-medium text-red-500">{{ $errors->first() }}</p>
                        @endif


                        <x-form.checkbox name="remember_me">Remember Me</x-form.checkbox>

                        <button class="w-full px-4 py-2 font-semibold text-white bg-black hover:bg-red-700">Login</button>
                        <a href="{{ route('register') }}" class="font-light underline">Don't have an account? register
                            now.</a>
                    </div>
                    <span class="text-center">Or</span>
                    <a href="{{ route('google-auth') }}" type="button" class="login-with-google-btn" >
                        Sign in with Google
                    </a>

                </form>
            </div>
        </div>

    </div>
@endsection
