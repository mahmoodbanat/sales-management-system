<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    // عرض قائمة المبيعات
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    // عرض نموذج إضافة بيع جديد
    public function create()
    {
        return view('sales.create');
    }

    // حفظ بيانات البيع الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        Sale::create($request->all());

        return redirect()->route('sales.index')->with('success', 'تمت إضافة البيع بنجاح');
    }

    // عرض تفاصيل بيع محدد
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    // عرض نموذج تعديل بيانات بيع موجود
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales.edit', compact('sale'));
    }

    // تحديث بيانات البيع في قاعدة البيانات
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($request->all());

        return redirect()->route('sales.index')->with('success', 'تم تحديث بيانات البيع بنجاح');
    }

    // حذف بيع من قاعدة البيانات
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'تم حذف البيع بنجاح');
    }
}
