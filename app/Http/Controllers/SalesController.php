<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SalesController extends Controller
{
    // قائمة المبيعات
    public function index()
    {
        $sales = Sale::latest()->get();
        return view('sales.index', compact('sales'));
    }

    // نموذج إضافة بيع
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('sales.create', compact('products'));
    }

    // حفظ بيع جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'          => ['nullable','string','max:255'],
            'items'                  => ['required','array','min:1'],
            'items.*.product_id'     => ['required','integer','exists:products,id'],
            'items.*.quantity'       => ['required','integer','min:1'],
        ]);

        return DB::transaction(function () use ($data) {
            $sale = Sale::create([
                'customer_name' => $data['customer_name'] ?? 'بدون اسم',
                'date'          => Carbon::now(),
                'total'         => 0,
            ]);

            $subtotal = 0;
            $hasItemTotal = Schema::hasColumn('sale_items', 'total'); // لو عمود total موجود

            foreach ($data['items'] as $row) {
                $product = Product::lockForUpdate()->find($row['product_id']);
                $qty     = (int) $row['quantity'];

                if ($product->quantity < $qty) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'items' => "الكمية المطلوبة من ({$product->name}) غير متوفرة. المتاح: {$product->quantity}.",
                    ]);
                }

                $lineTotal = $product->price * $qty;

                // إنشاء العنصر
                $itemData = [
                    'sale_id'    => $sale->id,
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ];
                if ($hasItemTotal) {
                    $itemData['total'] = $lineTotal;
                }
                SaleItem::create($itemData);

                // خصم المخزون
                $product->decrement('quantity', $qty);

                $subtotal += $lineTotal;
            }

            $sale->update(['total' => $subtotal]);

            return redirect()->route('sales.index')->with('success', 'تمت إضافة عملية البيع بنجاح.');
        });
    }

    // عرض تفاصيل بيع
    public function show($id)
    {
        $sale = Sale::with(['items.product'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    // حذف بيع
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $sale = Sale::with('items')->findOrFail($id);

            // (اختياري) إعادة المخزون عند الحذف
            foreach ($sale->items as $item) {
                Product::where('id', $item->product_id)->increment('quantity', $item->quantity);
            }

            $sale->items()->delete();
            $sale->delete();
        });

        return redirect()->route('sales.index')->with('success', 'تم حذف عملية البيع بنجاح.');
    }
}
