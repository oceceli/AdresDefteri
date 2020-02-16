@extends('layouts.app')

@section('content')

<div class="flex justify-center bg-gray-200 h-full items-center">
    <div class="bg-blue-900 w-96 rounded-lg shadow-xl p-6">
        <h3 class="text-white">
            <svg class="fill-current text-white w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M3.9 4.2c-.5 0-.8.3-.8.8s.4.8.8.8c.5 0 .8-.4.8-.8.1-.5-.3-.8-.8-.8zM3.3 18.6c0 1.4-.2 2.1-1.5 2.1-.3 0-.7 0-.9-.1l-.3 1.1c.3.1.7.2 1.1.2 1.9 0 2.7-1.2 2.7-3.2V8.1H3.3v10.5zM9.4 17.5c1.4 0 2.3-.4 3-1.2.8-1 1.1-2.1 1.1-3.8 0-1.4-.2-2.7-1-3.5-.6-.7-1.5-1.1-2.9-1.1s-2.3.4-3 1.2c-.8 1-1.1 2.2-1.1 3.8 0 1.5.2 2.6 1 3.5.6.7 1.5 1.1 2.9 1.1zM7.5 9.7c.3-.4.9-.8 2-.8 1 0 1.6.3 1.9.7.5.6.7 1.7.7 2.9s-.2 2.4-.7 3.1c-.3.4-.9.8-2 .8-1 0-1.6-.3-1.9-.7-.5-.6-.7-1.6-.7-2.9 0-1.2.2-2.4.7-3.1zM15 14.4c0 2.1.4 3.1 2.5 3.1.6 0 1.3-.1 1.8-.2l-.1-1c-.5.1-1 .2-1.5.2-1.4 0-1.5-.6-1.5-2.1v-5h3V8.3h-3v-3l-1.2.2v2.7h-1.8v1.1H15v5.1zM6 18h17v1H6z"/>
            </svg>
        </h3>

        <h1 class="text-white text-3xl pt-8">Üye ol!</h1>
        <h1 class="text-white text-sm text-blue-300">Aşağıdaki formu doldurarak kaydolun.</h1>

        <form method="POST" action="{{ route('register') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="name" class="pl-3 pt-2 absolute uppercase text-xs font-bold text-blue-500">{{ __('Ad soyad') }}</label>

                    <input id="name" type="text"
                    class="w-full pt-8 p-3 bg-blue-800 outline-none rounded text-gray-300 
                            focus:bg-blue-700 shadow-inner
                    @error('name') is-invalid @enderror" 
                    name="name" value="{{ old('name') }}" 
                    autocomplete="name"
                    placeholder="Adınız" autofocus>
                    
                    <div class="mt-2 bg-red-500 rounded text-center">
                        @error('name')
                            <span class="text-white" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </div>
            </div>

            <div class="relative pt-3">
                <label for="email" class="absolute pl-3 pt-2 text-white text-xs text-blue-500 font-bold uppercase">{{ __('E-Posta') }}</label>

                <div class="">
                    <input id="email" type="email" 
                    class="w-full bg-blue-800 text-gray-300 pt-8 rounded outline-none focus:bg-blue-700 p-3
                    @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" 
                    placeholder="örnek@eposta.com"
                    autocomplete="email">

                    <div class="mt-2 bg-red-500 rounded text-center">
                        @error('email')
                            <span class="text-white" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </div>
                </div>
            </div>

            <div class="relative pt-3">
                <label for="password" class="absolute pl-3 pt-2 text-blue-500 font-bold uppercase text-xs">{{ __('Şifre') }}</label>

                    <input id="password" type="password" 
                    class="w-full bg-blue-800 pt-8 p-3 rounded outline-none focus:bg-blue-700 text-gray-300
                    @error('password') is-invalid @enderror" 
                    name="password"  
                    placeholder="Şifreniz"
                    autocomplete="new-password">

                    <div class="mt-2 bg-red-500 rounded text-center">
                        @error('password')
                            <span class="text-white" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </div>
            </div>

            <div class="relative pt-3">
                <label for="password-confirm" class="absolute pl-3 pt-2 text-blue-500 font-bold uppercase text-xs">{{ __('Şifre Tekrar') }}</label>

                <div class="">
                    <input id="password-confirm" type="password" 
                    class="w-full p-3 pt-8 rounded bg-blue-800 outline-none focus:bg-blue-700 text-gray-300" 
                    name="password_confirmation" 
                    placeholder="Şifrenizi tekrar girin"
                    autocomplete="new-password">
                </div>
            </div>

            <div class="pt-5">
                <button type="submit" class="w-full bg-gray-400 text-blue-900 font-bold text-xl rounded text-left pl-3 py-2">
                {{ __('Kayıt Ol') }}
                </button>
            </div>
        </form>

        <div class="pt-8 flex justify-between text-gray-300 font-bold text-xs">
            <a href="/password/reset">Şifremi Unuttum</a>
            <a href="/login">Giriş Yap</a>
        </div>

    </div>
        
</div>

@endsection
