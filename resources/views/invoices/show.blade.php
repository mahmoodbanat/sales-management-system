@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            تفاصيل الفاتورة #{{ $invoice->id }}
        </h2>

        <div class="mb-6 bg-white p-4 rounded shadow">
            <p><strong>اسم العميل:</strong> {{ $invoice->customer_name ?? 'غير محدد' }}</p>
            <p><strong>تاريخ الإنشاء:</strong> {{ $invoice->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>الإجمالي:</strong> {{ number_format($invoice->total, 2) }} جنيه</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-bold mb-2">المنتجات:</h3>
            <table class="w-full border">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">المنتج</th>
                    <th class="border px-4 py-2">السعر</th>
                    <th class="border px-4 py-2">الكمية</th>
                    <th class="border px-4 py-2">الإجمالي</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->product->name }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->price, 2) }} جنيه</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->total, 2) }} جنيه</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 text-black px-4 py-2 rounded">⬅️ رجوع</a>
        </div>
    </div>
@endsection
