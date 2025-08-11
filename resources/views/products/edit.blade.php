@extends('layouts.app')

@section('title', 'تعديل المنتج: ' . $product->name)

@section('content')
    <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-6">
        تعديل المنتج: {{ $product->name }}
    </h2>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">اسم المنتج</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">الوصف</label>
                        <textarea name="description" class="w-full mt-1 p-2 border rounded">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">السعر</label>
                        <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">الكمية</label>
                        <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-blue-400 px-4 py-2 rounded hover:bg-blue-700">
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
