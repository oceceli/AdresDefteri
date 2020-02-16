@extends('layouts.app')

@section('content')

<div class="flex justify-center bg-gray-300 h-full items-center">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-blue-900 w-96 p-4 rounded-lg">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h3 class="text-white">
                <svg class="fill-current text-white w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M3.9 4.2c-.5 0-.8.3-.8.8s.4.8.8.8c.5 0 .8-.4.8-.8.1-.5-.3-.8-.8-.8zM3.3 18.6c0 1.4-.2 2.1-1.5 2.1-.3 0-.7 0-.9-.1l-.3 1.1c.3.1.7.2 1.1.2 1.9 0 2.7-1.2 2.7-3.2V8.1H3.3v10.5zM9.4 17.5c1.4 0 2.3-.4 3-1.2.8-1 1.1-2.1 1.1-3.8 0-1.4-.2-2.7-1-3.5-.6-.7-1.5-1.1-2.9-1.1s-2.3.4-3 1.2c-.8 1-1.1 2.2-1.1 3.8 0 1.5.2 2.6 1 3.5.6.7 1.5 1.1 2.9 1.1zM7.5 9.7c.3-.4.9-.8 2-.8 1 0 1.6.3 1.9.7.5.6.7 1.7.7 2.9s-.2 2.4-.7 3.1c-.3.4-.9.8-2 .8-1 0-1.6-.3-1.9-.7-.5-.6-.7-1.6-.7-2.9 0-1.2.2-2.4.7-3.1zM15 14.4c0 2.1.4 3.1 2.5 3.1.6 0 1.3-.1 1.8-.2l-.1-1c-.5.1-1 .2-1.5.2-1.4 0-1.5-.6-1.5-2.1v-5h3V8.3h-3v-3l-1.2.2v2.7h-1.8v1.1H15v5.1zM6 18h17v1H6z"/>
                </svg>
            </h3>

            <h1 class="text-2xl text-white pt-8">Şifreyi Sıfırla</h1>
            <h1 class="text-xs text-blue-400">Bunun için aşağıya e-posta adresini yaz</h1>

            <div class="relative pt-8">
                <label for="email" class="absolute pt-2 pl-3 text-blue-500 text-xs font-bold uppercase">{{ __('E-Posta') }}</label>

                
                <input id="email" type="email" 
                class="w-full bg-blue-800 rounded pt-8 p-3 text-gray-300 outline-none focus:bg-blue-700
                @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}"
                autocomplete="email"
                placeholder="örnek@eposta.com"
                autofocus>

                <div class="mt-2 bg-red-500 rounded text-center">
                    @error('email')
                        <span class="text-white" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                
                
            </div>

            
            <div class="p-2 mt-6 bg-gray-400 rounded">
                <button type="submit" class="text-blue-800 font-bold text-sm">
                    {{ __('Kurtarma Bağlantısı Gönder') }}
                </button>
            </div>
        </form>

        <div class="mt-8 flex justify-between text-white text-xs font-bold">
            <a href="/login">Giriş Yap</a>
            <a href="/register">Kayıt Ol</a>
        </div>

    </div>
    
</div>       
@endsection
