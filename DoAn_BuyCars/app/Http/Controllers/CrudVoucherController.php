<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class CrudVoucherController extends Controller
{
    /**
     * Hiển thị danh sách voucher.
     */
    public function index()
    {
        $vouchers = Voucher::paginate(4); // Phân trang, 4 bản ghi mỗi trang
        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Hiển thị form tạo voucher mới.
     */
    public function create()
    {
        return view('admin.vouchers.crud'); 
    }

    /**
     * Lưu voucher mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'VoucherCode' => 'required|string|max:50|unique:vouchers,VoucherCode', // Đảm bảo VoucherCode không vượt quá 50 ký tự
            'DiscountPercentage' => 'required|numeric|min:0|max:100', // Kiểm tra giá trị giảm giá là phần trăm
            'ExpirationDate' => 'required|date', // Kiểm tra ngày hết hạn hợp lệ
            'IsActive' => 'required|boolean', // Kiểm tra trạng thái là boolean
        ]);

        Voucher::create([
            'VoucherCode' => $request->VoucherCode,
            'DiscountPercentage' => $this->calculateDiscountAmount($request->DiscountPercentage), // Tính toán giá trị giảm
            'ExpirationDate' => $request->ExpirationDate,
            'IsActive' => $request->IsActive,
        ]);

        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được thêm thành công!');
    }

    /**
     * Hiển thị chi tiết một voucher cụ thể.
     */
    public function show(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.show', compact('voucher'));
    }

    /**
     * Hiển thị form chỉnh sửa voucher.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Cập nhật thông tin voucher trong cơ sở dữ liệu.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'VoucherCode' => 'required|string|max:50|unique:vouchers,VoucherCode,' . $id . ',VoucherId', // Đảm bảo không trùng với voucher hiện tại
            'DiscountPercentage' => 'required|numeric|min:0|max:100', // Kiểm tra giá trị giảm giá là phần trăm
            'ExpirationDate' => 'required|date', // Kiểm tra ngày hết hạn hợp lệ
            'IsActive' => 'required|boolean', // Kiểm tra trạng thái là boolean
        ]);

        $voucher = Voucher::findOrFail($id);
        $voucher->update([
            'VoucherCode' => $request->VoucherCode,
            'DiscountAmount' => $this->calculateDiscountAmount($request->DiscountPercentage), // Tính toán giá trị giảm
            'ExpirationDate' => $request->ExpirationDate,
            'IsActive' => $request->IsActive,
        ]);

        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được cập nhật thành công!');
    }

    /**
     * Xóa voucher khỏi cơ sở dữ liệu.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được xóa thành công!');
    }

    /**
     * Tính toán giá trị giảm giá dựa trên phần trăm
     */
    private function calculateDiscountAmount($percentage)
    {
        // Giả định giá gốc, bạn có thể thay đổi theo logic thực tế của bạn
        $originalPrice = 100; // Ví dụ: giá gốc là 100
        return ($originalPrice * $percentage) / 100;
    }
}
