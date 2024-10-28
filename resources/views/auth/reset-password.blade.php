@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>

    @if (session('status'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('email') }}">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Reset Password</button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Back to Login</a>
        </div>
    </form>
</div>
@endsection
