<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(); // Lấy danh sách tất cả roles
        return view('admin.role.index', compact('roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'RoleName' => 'required|string|max:255',
            'Description' => 'nullable|string',
        ]);

        // Tạo mới role
        Role::create($request->only(['RoleName', 'Description']));

        return redirect()->route('role.index')->with('success', 'Role đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($RoleId)
    {

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all());

        return redirect()->route('role.index')->with('success', 'Role đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role đã được xóa thành công.');
    }
}