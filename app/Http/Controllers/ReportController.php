<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $customerName = $request->input('customer_name');

        // البحث في جدول المبيعات (sales)
        $query = Sale::query();

        if ($customerName) {
            $query->where('customer_name', 'like', "%$customerName%");
        }

        $sales = $query->get();

        // الإحصائيات
        $totalInvoices = Sale::count();
        $totalSales = Sale::sum('total');

        // أكثر 5 منتجات مبيعاً (من جدول الفواتير/العناصر)
        $topProducts = InvoiceItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->with('product')
            ->get();

        return view('reports.index', compact('sales', 'totalInvoices', 'totalSales', 'topProducts'));
    }
}
