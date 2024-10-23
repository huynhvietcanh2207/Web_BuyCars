<?php
// app/Http/Controllers/SubscriptionController.php

namespace App\Http\Controllers;

use App\Models\Subscription; // Đảm bảo rằng bạn có import đúng model
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Đăng ký nhận tin thành công!');
    }
}
