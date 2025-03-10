<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Simulate sending email (in production, use Mail::to($request->email)->send(new ResetPasswordMail($token));)
        return redirect()->back()->with('status', 'Link reset telah dikirim ke email Anda. (Simulasi: <a href="http://localhost:8000/reset-password/' . $token . '">Klik untuk reset password</a>)');
    }

    public function resetPasswordPage($token)
    {
        return view('reset_password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Check if the token exists in the password_reset_tokens table
        $resetToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$resetToken) {
            return redirect()->route('forgot-password')->with('error', 'Token tidak valid.');
        }

        // Find the user associated with the email in the reset token
        $user = DB::table('users')->where('email', $resetToken->email)->first();

        if (!$user) {
            return redirect()->route('forgot-password')->with('error', 'Email tidak ditemukan.');
        }

        // Update the password for the user
        DB::table('users')->where('email', $resetToken->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the reset token after using it
        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return redirect('/')->with('success', 'Password berhasil diubah.');
    }
}
