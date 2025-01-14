<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Display a login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login Page',
        ]);
    }

    /**
     * Authenticate user.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $maxAttempts = 5;
        $decaySeconds = 60;

        if (RateLimiter::tooManyAttempts($request->ip(), $maxAttempts, $decaySeconds)) {
            $seconds = RateLimiter::availableIn($request->ip());

            return back()->with('error', 'Too many login attempts. Please try again in ' . $seconds . ' seconds.');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($request->ip());

            // Check if the user attempted to log in more than maxAttempts times
            if (RateLimiter::attempts($request->ip(), $maxAttempts) >= $maxAttempts) {
                // The user exceeded maxAttempts, so they must wait for decaySeconds before logging in again
                RateLimiter::hit($request->ip(), $decaySeconds);
                $seconds = RateLimiter::availableIn($request->ip());
                return back()->with('error', 'You have exceeded the maximum number of login attempts. Please try again in ' . $seconds . ' seconds.');
            }

            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                return redirect()->intended('user/dashboard');
            }
        } else {
            RateLimiter::hit($request->ip(), $decaySeconds);
            $attemptsLeft = $maxAttempts - RateLimiter::attempts($request->ip(), $decaySeconds);

            if ($attemptsLeft > 0) {
                return back()->with('warning', 'Your provided credentials do not match our records. You have ' . $attemptsLeft . ' attempts left.');
            } else {
                return back()->with('error', 'Your provided credentials do not match our records. Please try again in ' . $decaySeconds . ' seconds.');
            }
        }
    }

    /**
     * Display a registration page.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register', [
            'title' => 'Register Page',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('auth/login')->with('success', 'Register success. Please login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('auth/login')->with('success', "You've been logged out.");
    }
}
