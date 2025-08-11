@extends('layouts.app')

@section('title', 'إضافة منتج جديد')

@section('content')
    <h2 class="text-xl font-semibold leading-tight text-gray-800 mb-6">
        إضافة منتج جديد
    </h2>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">اسم المنتج</label>
                        <input type="text" name="name" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">الوصف</label>
                        <textarea name="description" class="w-full mt-1 p-2 border rounded"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">السعر (جنيه)</label>
                        <input type="number" name="price" step="0.01" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">الكمية</label>
                        <input type="number" name="quantity" class="w-full mt-1 p-2 border rounded" required>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">
                            حفظ المنتج
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
