@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow">

        <h1 class="mb-6 text-xl font-bold">قائمة المبيعات</h1>

        <!-- زر إضافة عملية بيع جديدة -->
        <a href="{{ route('sales.create') }}" class="px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600 transition">
            إضافة بيع جديد +
        </a>

        <!-- جدول المبيعات -->
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full border border-gray-300 text-center text-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">العميل</th>
                    <th class="border px-4 py-2">التاريخ</th>
                    <th class="border px-4 py-2">المجموع</th>
                    <th class="border px-4 py-2">إجراءات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sales as $sale)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-2">{{ $sale->id }}</td>
                        <td class="border px-4 py-2">{{ $sale->customer_name }}</td>
                        <td class="border px-4 py-2">{{ $sale->date }}</td>
                        <td class="border px-4 py-2">{{ $sale->total }}</td>
                        <td class="border px-4 py-2 space-x-1 rtl:space-x-reverse">
                            <a href="{{ route('sales.show', $sale->id) }}" class="px-2 py-1 bg-blue-500 text-black rounded text-xs hover:bg-blue-600">عرض</a>
                            <a href="{{ route('sales.edit', $sale->id) }}" class="px-2 py-1 bg-yellow-500 text-black rounded text-xs hover:bg-yellow-600">تعديل</a>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 bg-red-500 text-black rounded text-xs hover:bg-red-600"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-4 text-gray-500">لا توجد مبيعات مسجلة</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
