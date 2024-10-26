<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function getMonthlyRevenue()
    {
        $totalRevenueByMonth = DB::table('cart_items')->selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, SUM(quantity * price) as total_revenue')
            ->groupByRaw('YEAR(updated_at), MONTH(updated_at)')->get();

        return view('revenue.index', compact('totalRevenueByMonth'));
    }
}
