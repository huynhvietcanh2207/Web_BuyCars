<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Đảm bảo đã import model User
use Illuminate\Validation\Rule;

class Login_registerController extends Controller
{
    public function index()
    {
        return view('login_register');
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|min:5|max:20|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|digits_between:10,12',
            'password' => 'required|string|min:8|max:20|confirmed|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[\W_]/',
        ]);

        // Lưu thông tin người dùng
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công
            return redirect()->route('index')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Đăng xuất thành công!');
    }
}
