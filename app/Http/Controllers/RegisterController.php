<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register.index');
    }

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

    public function actionregister(Request $request){
        Session::flash('name', $request->name);
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6'],
        //     ['name.required' => 'Nama Wajib Diisi',
        //     'email.required' => 'Email Wajib Diisi',
        //     'email.email' => 'Silahkan masukan Email yang valid',
        //     'email.unique' => 'Email sudah pernah digunakan, silahkan pilih email yang lain',
        //     'password.required' => 'Password Wajib Diisi',
        //     'password.min' => 'Minimal karakter Password 6 karakter']);
        $data = [
            'name' => $request->name,
            'telp' => $request->telp,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "User"
        ];
        User::create($data);
        return redirect('/login')->with('success', 'Data berhasil disimpan');
    }
}
