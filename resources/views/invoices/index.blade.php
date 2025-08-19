@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            كل الفواتير
        </h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('sales.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded">+ فاتورة جديدة</a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">اسم العميل</th>
                <th class="border px-4 py-2">الإجمالي</th>
                <th class="border px-4 py-2">تاريخ الإنشاء</th>
                <th class="border px-4 py-2">خيارات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td class="border px-4 py-2">{{ $sale->id }}</td>
                    <td class="border px-4 py-2">{{ $sale->customer_name ?? 'غير محدد' }}</td>
                    <td class="border px-4 py-2">{{ number_format($sale->total, 2) }} جنيه</td>
                    <td class="border px-4 py-2">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('sales.show', $sale->id) }}">عرض</a>

                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-3">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $sales->links() }}
        </div>
    </div>
@endsection
