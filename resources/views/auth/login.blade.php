@extends('layouts.app')

@section('content')
    <div class="bg-white h-screen w-full">
        <div class="h-full w-full flex justify-center items-center">
            <div class="h-auto w-full sm:w-[400px] flex justify-center items-center flex-col shadow-xl border-2 border-gray-light rounded-xl p-6 gap-y-4">
                <a href="{{ route('home') }}" class="w-full h-auto flex flex-row items-center justify-center px-12">
                    <div class="w-auto flex flex-row">
                        <h3 class="font-bold text-primary">
                            Lan
                        </h3>
                        <h3 class="font-bold text-primary-dark">
                            Ex
                        </h3>
                    </div>
                </a>

                <p class="font-bold text-sm text-secondary-dark capitalize">{{__('messages.dashboard.auth.login')}}</p>

                <form action="{{ route('login') }}" method="POST" class="w-full h-full flex flex-col items-start justify-center gap-y-2">
                    @csrf

                    <label for="email" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.auth.email") }}</label>
                    <input type="email" id="email" name="email" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('email', '') }}" placeholder="{{ __("messages.dashboard.auth.email") }}">

                    <label for="password" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.auth.password") }}</label>
                    <span class="relative w-full">
                        <input type="password" id="password" name="password" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" placeholder="{{ __("messages.dashboard.auth.password") }}">
                        <span id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </span>


                    <button  type="submit"  class="mt-4 mx-auto px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                        {{ __('messages.dashboard.auth.login') }}
                    </button>
                </form>
                <a  href="{{ route('showForgotPassword') }}" class="capitalize hover:underline text-sm text-secondary-dark font-bold duration-300">{{ __('messages.dashboard.auth.forgot_password') }}</a>
                <a href="{{ route('showRegister') }}" class="hover:underline text-sm font-bold duration-300 text-secondary-dark capitalize">{{ __('messages.dashboard.auth.register') }}</a>
            </div>
        </div>
    </div>
@endsection

 <script>


        document.addEventListener("DOMContentLoaded", function () {

            @if(session('success'))
                showToast(["{{session('success')}}"]);
            @endif

            @if($errors->any())
                showToast(@json($errors->all()));
            @endif

            const passwordInput = document.getElementById("password");
            const togglePassword = document.getElementById("toggle-password");
            const eyeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>`;
            const eyeOffIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>`;

            togglePassword.addEventListener("click", function () {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    togglePassword.innerHTML = eyeOffIcon;
                } else {
                    passwordInput.type = "password";
                    togglePassword.innerHTML = eyeIcon;
                }
            });
        });
    </script>
