<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير المبيعات</title>
    <style>
        body {
            font-family: 'amiri', sans-serif;
            direction: rtl;
            text-align: right;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .summary {
            margin-bottom: 30px;
        }

        .summary div {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid #999;
        }

        th, td {
            padding: 8px 10px;
            text-align: center;
        }

        ul {
            padding-right: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    {{-- استبدل هذا المسار بمسار الشعار الفعلي --}}
    <img src="{{ public_path('logo.png') }}" alt="شعار المحل">
    <h1>محل الآيس كريم الخاص بك</h1>
</div>

<h2>تقرير المبيعات</h2>

<div class="summary">
    <div><strong>عدد الفواتير:</strong> {{ $totalInvoices }}</div>
    <div><strong>إجمالي المبيعات:</strong> {{ number_format($totalSales, 2) }} جنيه</div>
</div>

<h3>أفضل المنتجات مبيعًا</h3>
<ul>
    @forelse($topProducts as $product)
        <li>{{ $product['name'] }} - {{ $product['quantity'] }} قطعة</li>
    @empty
        <li>لا توجد منتجات</li>
    @endforelse
</ul>

<h3>تفاصيل الفواتير</h3>
<table>
    <thead>
    <tr>
        <th>رقم الفاتورة</th>
        <th>اسم العميل</th>
        <th>التاريخ</th>
        <th>عدد المنتجات</th>
        <th>المجموع</th>
    </tr>
    </thead>
    <tbody>
    @forelse($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->customer_name ?? 'غير محدد' }}</td>
            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
            <td>{{ $invoice->items->sum('quantity') }}</td>
            <td>{{ number_format($invoice->total, 2) }} جنيه</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">لا توجد فواتير</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
