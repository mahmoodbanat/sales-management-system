<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->paginate(10); // نعرض 10 فواتير في كل صفحة
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $products = Product::all();
        return view('invoices.create', compact('products'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('items.product')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }


    public function store(Request $request)
    {
        // ✅ التحقق من البيانات
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // ✅ إنشاء الفاتورة
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'total' => 0, // مؤقتًا، هنحسبه بعدين
        ]);

        $total = 0;

        // ✅ حفظ كل منتج داخل الفاتورة
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $quantity = $item['quantity'];
            $price = $product->price;
            $itemTotal = $price * $quantity;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $itemTotal,
            ]);

            $total += $itemTotal;
        }

        // ✅ تحديث المجموع الكلي
        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.index')->with('success', 'تم حفظ الفاتورة بنجاح');
    }
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        // حذف العناصر المرتبطة أولاً
        $invoice->items()->delete();

        // ثم حذف الفاتورة نفسها
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'تم حذف الفاتورة بنجاح');
    }

}
