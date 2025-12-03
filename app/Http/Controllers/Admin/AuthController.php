<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $admin = DB::table('admins')->where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['Invalid credentials.']);
        }

        session([
            'admin_id' => $admin->id,
            'is_admin' => true
        ]);

        return redirect()->route('admin.tickets.index');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }
}
