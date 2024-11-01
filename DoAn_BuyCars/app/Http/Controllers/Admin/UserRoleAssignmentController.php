<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRoleAssignment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserRoleAssignmentController extends Controller
{
    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.role.assign_role', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:user_roles,id',
        ]);

        UserRoleAssignment::create([
            'user_id' => $request->user_id,
            'RoleId' => $request->role_id,
            'AssignedAt' => now(),
        ]);

        return redirect()->route('role.index')->with('success', 'Phân quyền thành công!');
    }
}