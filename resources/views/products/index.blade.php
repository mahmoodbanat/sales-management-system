@extends('layouts.app')

@section('title', 'المنتجات')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        📦 المنتجات
    </h2>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- زر إضافة منتج -->
            <a href="{{ route('products.create') }}"
               class="mb-6 inline-block bg-blue-600 hover:bg-blue-700 text-black font-semibold py-2 px-5 rounded-lg shadow transition">
                + منتج جديد
            </a>

            <!-- جدول المنتجات -->
            <div class=" ">
                @if($products->count())
                    <table class="min-w-full bg-whit  border border-gray-200">
                        <thead class="bg-white shadow rounded-lg overflow-hidden">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">الاسم</th>
                            <th class="border px-4 py-2">السعر</th>
                            <th class="border px-4 py-2">الكمية</th>
                            <th class="border px-4 py-2">الإجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border p-3">{{ $product->id }}</td>
                                <td class="border p-3 font-medium">{{ $product->name }}</td>
                                <td class="border p-3">{{ $product->price }} ج.م</td>
                                <td class="border p-3">{{ $product->quantity }}</td>
                                <td class="border p-3 space-x-2 space-x-reverse">
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="text-blue-600 hover:underline">تعديل</a>
                                    <span>|</span>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline"
                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-6 text-gray-600 text-center">🚫 لا توجد منتجات حتى الآن.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
