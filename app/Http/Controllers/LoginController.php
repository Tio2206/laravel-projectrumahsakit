<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function actionlogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Rate Limiter
        $attemptsKey = 'login_attempts_' . $email;
        $maxAttempts = 5;
        $lockoutTime = 60; // 1 minute

        $attempts = Cache::get($attemptsKey, ['count' => 0, 'locked' => false, 'expires_at' => time()]);

        if ($attempts['locked'] && $attempts['expires_at'] > time()) {
            $remainingTime = max(0, $attempts['expires_at'] - time());
            Session::flash('error', 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $remainingTime . ' detik.');
            return redirect('/login');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            Session::flash('error', 'Email yang anda masukkan salah.');
            return redirect('/login');
        }

        if (!Hash::check($password, $user->password)) {
            $attempts['count']++;

            if ($attempts['count'] >= $maxAttempts) {
                $attempts['locked'] = true;
                $attempts['expires_at'] = time() + $lockoutTime;
            }

            Cache::put($attemptsKey, $attempts, $lockoutTime);

            Session::flash('error', $attempts['locked']
                ? 'Terlalu banyak percobaan login. Silakan coba lagi dalam 1 menit.'
                : 'Password anda salah. Percobaan tersisa: ' . ($maxAttempts - $attempts['count']) . '.');

            return redirect('/login');
        }

        // Login successful, clear cache
        Cache::forget($attemptsKey);

        Auth::login($user);
        return redirect('/');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
