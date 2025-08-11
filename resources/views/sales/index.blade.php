@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white">
        <h1 class="mb-4">قائمة المبيعات</h1>

        <!-- زر إضافة عملية بيع جديدة -->
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-4">إضافة بيع جديد+</a>

        <!-- جدول المبيعات -->
        <table class="min-w-full border border-gray-200 mt-3">
            <thead>
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">العميل</th>
                <th class="border px-4 py-2">التاريخ</th>
                <th class="border px-4 py-2">المجموع</th>
                <th class="border px-4 py-2">إجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">عرض</a>
                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
