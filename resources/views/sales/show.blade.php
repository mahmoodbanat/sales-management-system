@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>تفاصيل البيع رقم {{ $sale->id }}</h1>
        <p><strong>اسم العميل:</strong> {{ $sale->customer_name }}</p>
        <p><strong>التاريخ:</strong> {{ $sale->date }}</p>
        <p><strong>المجموع:</strong> {{ $sale->total }}</p>

        <a href="{{ route('sales.index') }}" class="btn btn-secondary">عودة لقائمة المبيعات</a>
    </div>
@endsection
