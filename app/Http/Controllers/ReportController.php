<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{public function index(Request $request)
{
    $query = Invoice::query();

    // فلترة حسب التاريخ
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }
    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    // فلترة حسب اسم العميل
    if ($request->filled('customer_name')) {
        $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
    }

    // استرجاع الفواتير بعد الفلترة
    $invoices = $query->with('items.product')->get();

    // فلترة باسم المنتج
    $filteredInvoices = $invoices;
    if ($request->filled('product_name')) {
        $filteredInvoices = $invoices->filter(function ($invoice) use ($request) {
            return $invoice->items->contains(function ($item) use ($request) {
                return stripos($item->product->name, $request->product_name) !== false;
            });
        });
    }

    $totalSales = $filteredInvoices->sum('total');
    $invoiceCount = $filteredInvoices->count();
    $totalItems = $filteredInvoices->flatMap->items->sum('quantity');

    // ✅ استخراج أكثر المنتجات مبيعًا
    $topProducts = DB::table('invoice_items')
        ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->get()
        ->map(function ($item) {
            $product = Product::find($item->product_id);
            return [
                'name' => $product ? $product->name : 'غير معروف',
                'quantity' => $item->total_quantity,
            ];
        });
    $totalInvoices = $filteredInvoices->count();

// استخراج أفضل المنتجات مبيعًا
    $topProducts = [];

    foreach ($filteredInvoices as $invoice) {
        foreach ($invoice->items as $item) {
            $name = $item->product->name;
            if (!isset($topProducts[$name])) {
                $topProducts[$name] = 0;
            }
            $topProducts[$name] += $item->quantity;
        }
    }

// تحويلها إلى ترتيب
    $topProducts = collect($topProducts)
        ->map(function ($quantity, $name) {
            return ['name' => $name, 'quantity' => $quantity];
        })
        ->sortByDesc('quantity')
        ->values()
        ->take(5); // أفضل 5 منتجات مثلًا

    return view('reports.index', [
        'invoices' => $filteredInvoices,
        'totalSales' => $totalSales,
        'invoiceCount' => $invoiceCount,
        'totalItems' => $totalItems,
        'totalInvoices' => $totalInvoices, // ✅ تم إضافته
        'topProducts' => $topProducts,     // ✅ تم إضافته
    ]);
}


    public function exportPdf(Request $request)
    {
        // نفس فلترة index
        $query = Invoice::query();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        $invoices = $query->with('items.product')->get();

        if ($request->filled('product_name')) {
            $invoices = $invoices->filter(function ($invoice) use ($request) {
                return $invoice->items->contains(function ($item) use ($request) {
                    return stripos($item->product->name, $request->product_name) !== false;
                });
            });
        }

        $totalSales = $invoices->sum('total');
        $totalInvoices = $invoices->count();
        $totalItems = $invoices->flatMap->items->sum('quantity');

        // حساب أفضل المنتجات
        $topProducts = $invoices->flatMap->items
            ->groupBy('product_id')
            ->map(function ($items) {
                return [
                    'name' => optional($items->first()->product)->name ?? 'غير معروف',
                    'quantity' => $items->sum('quantity')
                ];
            })->sortByDesc('quantity')->take(5)->values()->all();

        // تحميل PDF من view
        $pdf = Pdf::loadView('reports.pdf', compact('invoices', 'totalSales', 'totalInvoices', 'topProducts'));

        return $pdf->download('تقرير_المبيعات.pdf');
    }
}


