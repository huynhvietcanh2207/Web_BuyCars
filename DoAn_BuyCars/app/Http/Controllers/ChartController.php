<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Role;
use App\Models\UserRoleAssignment;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // return view("admin.chart.index");
        $userCount = $this->countUserWithRole();
        $brandCount = $this->countBrand();
        // $totalCartValue = $this->calculateTotalCartValue();

        return view('admin.chart.index', compact('userCount', 'brandCount'));
    }

    public function countUserWithRole()
    {
        // Lấy RoleId có vai trò user
        $role = Role::where('RoleName', 'user')->first();

        if ($role) {
            
            $userCount = UserRoleAssignment::where('RoleId', $role->id)->count();

        } else {
            $userCount = 0;
        }

        return  $userCount;
    }

    public function countBrand(){
        return Brand::count();
    }

    // public function calculateTotalCartValue(){
        
    // }
}
