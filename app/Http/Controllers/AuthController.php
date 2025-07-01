<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|string|in:admin,manager,user',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user',
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        
        if ($request->expectsJson()) {
            return response()->json(['user' => $user, 'token' => $token], 201);
        }
        
        return redirect('/dashboard')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            
            return redirect()->back()->with('error', 'The provided credentials are incorrect.');
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        if ($request->expectsJson()) {
            return response()->json(['user' => $user, 'token' => $token]);
        }
        
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Login successful!');
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }
        
        Auth::logout();
        
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logged out successfully']);
        }
        
        return redirect('/login')->with('success', 'Logged out successfully');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email.'])
            : response()->json(['message' => 'Unable to send reset link.'], 400);
    }

    public function showLoginForm()
    {
        return view('login');
    }
    
    public function dashboard()
    {
        return view('dashboard');
    }
}

