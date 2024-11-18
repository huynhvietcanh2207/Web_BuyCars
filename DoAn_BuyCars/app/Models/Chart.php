<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chart extends Model
{
    use HasFactory;

    public function countUserWithRole()
    {
        $role = Role::where('RoleName', 'user')->first();
        return $role ? UserRoleAssignment::where('RoleId', $role->id)->count() : 0;
    }
    public function countBrand()
    {
        return Brand::count();
    }
    public function calculateTotalCartValue()
    {
        return CartItem::sum(DB::raw('quantity * price'));
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
    public function calculateIncome()
    {
        return CartItem::sum(DB::raw('quantity * price'));
    }
    public function calculateExpenses()
    {
        return Product::sum(DB::raw('quantity * price'));
    }
    public function getUserStatistics()
    {
        $userCounts = DB::table('user_role_assignments')->select(DB::raw('MONTH(AssignedAt) as month'), DB::raw('COUNT(*) as count'))->where('RoleID', 2)->groupBy('month')->orderBy('month')->get();
        $months = [];
        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = "Tháng " . $i;
            $userCount = $userCounts->firstWhere('month', $i);
            $counts[] = $userCount ? $userCount->count : 0;
        }
        return ['months' => $months, 'counts' => $counts,];
    }
    public function getBrandStatistics()
    {
        $brandStatistics = DB::table('cart_items')->join('products', 'cart_items.ProductId', '=', 'products.ProductId')->join('brands', 'products.BrandId', '=', 'brands.BrandId')->select('brands.BrandName', DB::raw('MONTH(cart_items.updated_at) as month'), DB::raw('SUM(cart_items.quantity) as total_quantity'))->groupBy('brands.BrandName', DB::raw('MONTH(cart_items.updated_at)'))->orderBy('month')->get();
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
                return $monthlyData[$month][$index] ?? 0;
            }, range(1, 12));
        }
        return ['labels' => $labels, 'data' => $monthlyDataFormatted,];
    }
}
