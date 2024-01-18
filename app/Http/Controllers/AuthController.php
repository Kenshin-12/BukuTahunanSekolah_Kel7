<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        if (!Auth::user()) {
            return view('auth.login');
        }

        return redirect()->to('/beranda');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)) {

            if (Auth::user()->role == 'admin') :
                return Auth::user();
            else :
                return redirect()->to('/beranda');
            endif;
        } else
            return response()->json('failed', 401);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
