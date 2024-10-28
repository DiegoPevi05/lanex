@extends('layouts.app')

@section('content')
    <div class="bg-white h-screen w-full">
        <div class="h-full w-full flex justify-center items-center">
            <div class="h-auto w-full sm:w-[400px] flex justify-center items-center flex-col shadow-xl border-2 border-gray-light rounded-xl p-6 gap-y-4">
                <h2 class="font-bold text-secondary-dark capitalize">{{ __('messages.dashboard.auth.reset_password') }}</h2>
                @if(session('status'))
                    <div>{{ session('status') }}</div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="w-full h-full flex flex-col items-start justify-center gap-y-2">
                    @csrf

                    <label for="email" class="block text-sm font-bold text-secondary-dark capitalize">{{ __("messages.dashboard.auth.email") }}</label>
                    <input type="email" id="email" name="email" class="mt-2 text-sm block w-full p-2 border-b-2 border-b-secondary-dark bg-white focus:border-b-primary focus:outline-none text-body" value="{{ old('email', '') }}" placeholder="{{ __("messages.dashboard.auth.email") }}" required>

                    <button  type="submit"  class="mx-auto px-4 py-2 bg-primary text-white duration-300 hover:bg-primary-dark rounded-md active:scale-95 capitalize">
                        {{ __('messages.dashboard.auth.send_password_reset_link') }}
                    </button>
                </form>

                <a  href="{{ route('login') }}" class="capitalize hover:underline text-sm text-secondary-dark font-bold duration-300">{{ __('messages.dashboard.auth.back_to_login') }}</a>
            </div>
        </div>
    </div>
@endsection
