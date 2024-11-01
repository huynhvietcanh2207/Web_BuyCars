<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();

        // Kiểm tra nếu có tham số username trong đường dẫn
        if (request()->is('account/*')) {
            return redirect()->route('account.profile')
                ->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        // Lấy nhật ký hoạt động
        $activityLogs = ActivityLog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('account.profile', compact('user', 'activityLogs'));
    }


    public function updateAvatar(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'avatar.required' => 'Bạn chưa chọn tệp ảnh.',
            'avatar.image' => 'Tệp tải lên phải là một hình ảnh.',
            'avatar.mimes' => 'Hình ảnh phải có định dạng jpeg, png hoặc jpg.',
            'avatar.max' => 'Kích thước tệp ảnh không được vượt quá 1 MB.',
        ]);

        $user = auth()->user();

        // Xóa ảnh cũ nếu có
        if ($user->profile_image) {
            Storage::delete('public/' . $user->profile_image);
        }

        // Lưu ảnh mới vào thư mục avatars trong storage
        $path = $request->file('avatar')->store('avatars', 'public');

        // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
        $user->profile_image = $path;
        $user->save();

        // Ghi nhật ký
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Đã cập nhật ảnh đại diện.',
        ]);

        return redirect()->back()->with('success', 'Ảnh đại diện đã được cập nhật thành công.');
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:male,female,other',
            'birthdate' => 'nullable|before_or_equal:today',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->save();

        // Ghi nhật ký
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Đã cập nhật thông tin cá nhân.',
        ]);

        return redirect()->back()->with('success', 'Thông tin hồ sơ đã được cập nhật thành công.');
    }

}