@extends('layouts.app')

@section('title', 'التقارير')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">التقارير</h2>

    {{-- فلتر البحث --}}
    <div class="bg-white p-6 shadow rounded-lg my-6">
        <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="from" class="block text-sm font-medium text-gray-700">من تاريخ</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="to" class="block text-sm font-medium text-gray-700">إلى تاريخ</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700">اسم العميل</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ request('customer_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="product_name" class="block text-sm font-medium text-gray-700">اسم المنتج</label>
                <input type="text" name="product_name" id="product_name" value="{{ request('product_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-blue-500 font-semibold px-4 py-2 rounded w-full">بحث</button>
            </div>
        </form>
    </div>

    {{-- ملخص المبيعات --}}
    <div class="p-6 bg-white rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4 text-gray-800">ملخص المبيعات</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>عدد الفواتير: <strong>{{ $totalInvoices }}</strong></div>
            <div>إجمالي المبيعات: <strong>{{ number_format($totalSales, 2) }} جنيه</strong></div>
        </div>

        <h4 class="text-md font-bold mb-2 text-gray-800">أفضل المنتجات مبيعًا:</h4>
        <ul class="list-disc pl-5 text-sm text-gray-700">
            @foreach ($topProducts as $product)
                <li>{{ $product['name'] }} - {{ $product['quantity'] }} قطعة</li>
            @endforeach
        </ul>
    </div>

    {{-- جدول الفواتير --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4 text-gray-800">تفاصيل الفواتير</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200 text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-800 font-semibold">
                <tr>
                    <th class="border px-4 py-2">رقم الفاتورة</th>
                    <th class="border px-4 py-2">اسم العميل</th>
                    <th class="border px-4 py-2">التاريخ</th>
                    <th class="border px-4 py-2">عدد المنتجات</th>
                    <th class="border px-4 py-2">المجموع</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $invoice)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $invoice->id }}</td>
                        <td class="border px-4 py-2">{{ $invoice->customer_name ?? 'غير محدد' }}</td>
                        <td class="border px-4 py-2">{{ $invoice->created_at->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">{{ $invoice->items->sum('quantity') }}</td>
                        <td class="border px-4 py-2">{{ number_format($invoice->total, 2) }} جنيه</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">لا توجد فواتير مطابقة لفلتر البحث</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-4 text-left">
                <a href="{{ route('reports.pdf', request()->all()) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-blue-500 font-semibold px-4 py-2 rounded inline-block">
                    تصدير إلى PDF
                </a>
            </div>
        </div>
    </div>
@endsection
