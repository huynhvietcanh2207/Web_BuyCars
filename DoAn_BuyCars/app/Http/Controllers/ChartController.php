<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    protected $chart;
    public function __construct(Chart $chart)
    {
        $this->chart = $chart;
    }
    public function index()
    {
        $userCount = $this->chart->countUserWithRole();
        $brandCount = $this->chart->countBrand();
        $commentCount = $this->chart->getFormattedCommentCount();
        $favoriteCount = $this->chart->getFormattedFavoriteCount();
        $income = $this->chart->calculateIncome();
        $expenses = $this->chart->calculateExpenses();
        $userStatistics = $this->chart->getUserStatistics();
        $brandStatistics = $this->chart->getBrandStatistics();
        return view('admin.chart.index', compact('userCount', 'brandCount', 'commentCount', 'favoriteCount', 'income', 'expenses', 'userStatistics', 'brandStatistics'));
    }
}
