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
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->limit(7)
            ->get();

        // تجهيز بيانات الرسم البياني
        $dates = $salesData->pluck('date');
        $totals = $salesData->pluck('total');

        // عدد المنتجات
        $totalProducts = DB::table('products')->count();

        // عدد المبيعات
        $totalSales = DB::table('sales')->count();

        // عدد المستخدمين
        $totalUsers = DB::table('users')->count();

        return view('dashboard.index', compact(
            'dates',
            'totals',
            'totalProducts',
            'totalSales',
            'totalUsers'
        ));
    }
}
