@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>تقرير المبيعات</h1>

        {{-- مربع البحث --}}
        <form method="GET" action="{{ route('reports.index') }}">
            <input type="text" name="customer_name" placeholder="ابحث باسم العميل"  required>
            <button type="submit">بحث</button>
        </form>

        <hr>

        {{-- الإحصائيات --}}
        <div>
            <p><strong>إجمالي عدد الفواتير:</strong> {{ $totalInvoices }}</p>
            <p><strong>إجمالي المبيعات:</strong> {{ $totalSales }}</p>
        </div>

        <hr>
        {{-- نتائج البحث --}}
        <h3>المبيعات</h3>
        @if($sales->count())
            <table border="1" cellpadding="5">
                <thead>
                <tr>
                    <th>رقم العملية</th>
                    <th>اسم العميل</th>
                    <th>الإجمالي</th>
                    <th>تاريخ الإنشاء</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->total }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>لا توجد مبيعات مطابقة.</p>
        @endif


        <hr>

        {{-- أكثر المنتجات مبيعاً --}}
        <h3>أكثر 5 منتجات مبيعاً</h3>
        @if($topProducts->count())
            <ul>
                @foreach($topProducts as $item)
                    <li>
                        {{ $item->product ? $item->product->name : 'منتج غير معروف' }}
                        - الكمية: {{ $item->total_quantity }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>لا توجد بيانات للمنتجات.</p>
        @endif
    </div>
@endsection
