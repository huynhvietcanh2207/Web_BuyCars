<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware để kiểm tra quyền truy cập
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->roles->contains('RoleName', 'admin')) {
                return redirect()->route('index')->with('error', 'Bạn không có quyền truy cập trang này vì bạn không đủ trình.');
            }
            return $next($request);
        });
    }

    public function indexAdmin()
    {
        return view('admin'); // Trả về view admin
    }
}
