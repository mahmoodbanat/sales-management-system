<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات المبيعات لآخر 7 أيام
        $salesData = DB::table('sales')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->limit(7)
            ->get();

        // عدد المنتجات
        $productsCount = DB::table('products')->count();

        // عدد المبيعات
        $salesCount = DB::table('sales')->count();

        // عدد المستخدمين
        $usersCount = DB::table('users')->count();

        return view('dashboard.index', compact('salesData', 'productsCount', 'salesCount', 'usersCount'));
    }
}
