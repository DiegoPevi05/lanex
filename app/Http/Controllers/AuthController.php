<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => __('messages.dashboard.auth.login_required_email'),
            'email.email' => __('messages.dashboard.auth.login_invalid_email'),
            'password.required' => __('messages.dashboard.auth.login_required_password'),
            'password.min' => __('messages.dashboard.auth.register_min_password'),
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard_home');
        }

        return back()->withErrors([
            'email' => __('messages.dashboard.auth.login_failed'),
        ]);
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'keyword' => 'required|string',
        ], [
            'name.required' => __('messages.dashboard.auth.register_required_name'),
            'name.max' => __('messages.dashboard.auth.register_invalid_name'),
            'email.required' => __('messages.dashboard.auth.register_required_email'),
            'email.email' => __('messages.dashboard.auth.register_invalid_email'),
            'email.unique' => __('messages.dashboard.auth.register_unique_email'),
            'password.required' => __('messages.dashboard.auth.register_required_password'),
            'password.min' => __('messages.dashboard.auth.register_min_password'),
            'password.confirmed' => __('messages.dashboard.auth.register_confirmed_password'),
            'keyword.required' => __('messages.dashboard.auth.register_required_keyword'),
        ]);

        // Check if the provided keyword matches the one in the .env file
        if ($request->keyword !== env('REGISTRATION_KEYWORD')) {
            return back()->withErrors(['keyword' => __('messages.dashboard.auth.register_invalid_keyword')]);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', __('messages.dashboard.auth.register_success'));
    }

    // Show reset password form
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Handle password reset email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email'], [
            'email.required' => __('messages.dashboard.auth.forgot_password_required_email'),
            'email.email' => __('messages.dashboard.auth.forgot_password_invalid_email'),
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __('messages.dashboard.auth.forgot_password_link_sent')])
            : back()->withErrors(['email' => __('messages.dashboard.auth.forgot_password_link_failed')]);
    }

    // Show reset password form
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle reset password request
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'token.required' => __('messages.dashboard.auth.reset_password_required_token'),
            'email.required' => __('messages.dashboard.auth.reset_password_required_email'),
            'email.email' => __('messages.dashboard.auth.reset_password_invalid_email'),
            'password.required' => __('messages.dashboard.auth.reset_password_required_password'),
            'password.min' => __('messages.dashboard.auth.reset_password_min_password'),
            'password.confirmed' => __('messages.dashboard.auth.reset_password_confirmed_password'),
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('messages.dashboard.auth.reset_password_success'))
            : back()->withErrors(['email' => __('messages.dashboard.auth.reset_password_failed')]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', __('messages.dashboard.auth.logout_success'));
    }
}
