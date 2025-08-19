@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>تفاصيل البيع رقم {{ $sale->id }}</h1>

        <p><strong>اسم العميل:</strong> {{ $sale->customer_name }}</p>
        <p><strong>اسم المنتج:</strong> {{ $sale->product_name }}</p>
        <p><strong>التاريخ:</strong> {{ $sale->date }}</p>
        <p><strong>الكمية:</strong> {{ $sale->quantity }}</p>
        <p><strong>السعر:</strong> {{ $sale->price }}</p>
        <p><strong>الإجمالي:</strong> {{ $sale->total }}</p>
        <p><strong>تم الإنشاء في:</strong> {{ $sale->created_at }}</p>
        <p><strong>آخر تحديث:</strong> {{ $sale->updated_at }}</p>

        <a href="{{ route('sales.index') }}" class="btn btn-secondary">عودة لقائمة المبيعات</a>
    </div>
@endsection
