<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Role;
use App\Models\UserRoleAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // return view("admin.chart.index");
        $userCount = $this->countUserWithRole();
        $brandCount = $this->countBrand();
        $commentCount = $this->getFormattedCommentCount();
        $favoriteCount = $this->getFormattedFavoriteCount();

        $income = $this->calculateIncome(); // Lượng Thu
        $expenses = $this->calculateExpenses(); // Lượng Chi

        $userStatistics = $this->getUserStatistics();

        $brandStatistics = $this->getBrandStatistics();

        return view('admin.chart.index', compact('userCount', 'brandCount', 'commentCount', 'favoriteCount', 'income', 'expenses', 'userStatistics', 'brandStatistics'));
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

    public function countBrand()
    {
        return Brand::count();
    }

    public function calculateTotalCartValue()
    {
        $totalValue = CartItem::sum(DB::raw('quantity * price'));

        return $totalValue;
    }

    public function getFormattedCommentCount()
    {
        $commentCount = Comment::count();
        return $this->formatNumber($commentCount);
    }

    public function getFormattedFavoriteCount()
    {
        $favoriteCount = Favorite::count();
        return $this->formatNumber($favoriteCount);
    }

    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K';
        } else {
            return $number;
        }
    }

    //Lượng thu và chi
    public function calculateIncome()
    {
        return CartItem::sum(DB::raw('quantity * price'));
    }

    public function calculateExpenses()
    {
        return Product::sum('price');
    }

    //Số lượng người dùng theo tháng
    public function getUserStatistics()
    {
        $userCounts = DB::table('user_role_assignments')
            ->select(DB::raw('MONTH(AssignedAt) as month'), DB::raw('COUNT(*) as count'))
            ->where('RoleID', 2)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $counts = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = "Tháng " . $i;
            $userCount = $userCounts->firstWhere('month', $i);
            $counts[] = $userCount ? $userCount->count : 0;
        }
        return [
            'months' => $months,
            'counts' => $counts,
        ];
    }

    public function getBrandStatistics()
    {
        $brandStatistics = DB::table('cart_items')
        ->join('products', 'cart_items.ProductId', '=', 'products.ProductId')
        ->join('brands', 'products.BrandId', '=', 'brands.BrandId')
        ->select(
            'brands.BrandName',
            DB::raw('MONTH(cart_items.updated_at) as month'),
            DB::raw('SUM(cart_items.quantity) as total_quantity')
        )
            ->groupBy('brands.BrandName', DB::raw('MONTH(cart_items.updated_at)'))
            ->orderBy('month')
            ->get();

        $labels = $brandStatistics->pluck('BrandName')->unique()->toArray();

        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyData[$month] = [];
            foreach ($labels as $brand) {
                $total = $brandStatistics->where('BrandName', $brand)->where('month', $month)->sum('total_quantity');
                $monthlyData[$month][] = $total;
            }
        }

        $monthlyDataFormatted = [];
        foreach ($labels as $index => $label) {
            $monthlyDataFormatted[] = array_map(function ($month) use ($index, $monthlyData) {
                return $monthlyData[$month][$index] ?? 0; // Trả về 0 nếu không có dữ liệu
            }, range(1, 12)); // Tạo mảng 12 tháng
        }

        return [
            'labels' => $labels,
            'data' => $monthlyDataFormatted,
        ];
    }
}
