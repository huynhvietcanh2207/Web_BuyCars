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
        $sort_by = request()->input('sort_by', 'asc');

        $vouchers = Voucher::orderBy('VoucherId', $sort_by)->paginate(4);

        return view('admin.vouchers.index', compact('vouchers', 'sort_by'));
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
            'VoucherCode' => 'required|string|max:50|unique:vouchers,VoucherCode',
            'DiscountPercentage' => 'required|numeric|min:0|max:100',
            'ExpirationDate' => 'required|date',
            'IsActive' => 'required|boolean',
        ]);

        Voucher::create([
            'VoucherCode' => $request->VoucherCode,
            'DiscountPercentage' => $request->DiscountPercentage,
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
            'VoucherCode' => 'required|string|max:50|unique:vouchers,VoucherCode,' . $id . ',VoucherId',
            'DiscountPercentage' => 'required|numeric|min:0|max:100',
            'ExpirationDate' => 'required|date',
            'IsActive' => 'required|boolean',
        ]);

        // dd($request->all());
        $voucher = Voucher::findOrFail($id);
        $voucher->update([
            'VoucherCode' => $request->VoucherCode,
            'DiscountPercentage' => $request->DiscountPercentage,
            'ExpirationDate' => $request->ExpirationDate,
            'IsActive' => $request->IsActive,
        ]);
        // dd($voucher);

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
}
