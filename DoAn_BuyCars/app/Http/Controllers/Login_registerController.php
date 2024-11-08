<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Đảm bảo đã import model User
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator; // Import Validator

class Login_registerController extends Controller
{
    public function index()
    {
        return view('login_register');
    }

    public function store(Request $request)
    {
        // Tạo Validator
        $validator = Validator::make($request->only('name', 'email', 'phone_number', 'password', 'password_confirmation'), [
            'name' => 'required|string|min:5|max:20|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|digits_between:10,12',
            'password' => 'required|string|min:8|max:20|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[\W_]/',
            'password_confirmation' => 'required|same:password',  // Kiểm tra mật khẩu xác nhận có khớp không
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation cho ảnh

        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.min' => 'Tên phải có ít nhất :min ký tự.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',
            'name.regex' => 'Tên chỉ được chứa chữ cái và khoảng trắng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.numeric' => 'Số điện thoại phải là số.',
            'phone_number.digits_between' => 'Số điện thoại phải từ :min đến :max chữ số.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự viết hoa, một ký tự viết thường, một số và một ký tự đặc biệt.',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu.',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // Kiểm tra lỗi
        if ($validator->fails()) {
            // Gửi thông báo lỗi "vui lòng đăng ký lại!" qua session
            return redirect()->back()
                ->withErrors($validator, 'store') // Gắn lỗi vào error bag 'store'
                ->withInput()
                ->with('error', 'Vui lòng đăng ký lại!');
        }

        // Lưu thông tin người dùng
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'profile_image' => asset('default-avatar.png'),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }


    public function login(Request $request)
    {
        // Tạo Validator
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:20|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[\W_]/',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá :max ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự viết hoa, một ký tự viết thường, một số và một ký tự đặc biệt.',
        ]);

        // Kiểm tra lỗi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'login') // Gắn lỗi vào error bag 'login'
                ->withInput();
        }
        // Đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng
            if ($user->roles->contains('RoleName', 'admin')) {
                // Chuyển hướng đến trang admin nếu là admin
                return redirect()->route('admin')->with('success', 'Đăng nhập thành công với quyền Admin!');
            } else {
                // Chuyển hướng đến trang người dùng nếu là user
                return redirect()->route('index')->with('success', 'Đăng nhập thành công!');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Đăng xuất thành công!');
    }
}