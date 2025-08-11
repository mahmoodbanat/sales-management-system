{{-- resources/views/settings/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">تعديل الإعدادات العامة للنظام</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="store_name" class="block font-semibold mb-1">اسم المتجر</label>
            <input type="text" name="store_name" id="store_name" class="w-full border rounded p-2"
                   value="{{ old('store_name', $setting->store_name ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="currency" class="block font-semibold mb-1">العملة</label>
            <input type="text" name="currency" id="currency" class="w-full border rounded p-2"
                   value="{{ old('currency', $setting->currency ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="tax_percentage" class="block font-semibold mb-1">نسبة الضريبة (%)</label>
            <input type="number" step="0.01" name="tax_percentage" id="tax_percentage" class="w-full border rounded p-2"
                   value="{{ old('tax_percentage', $setting->tax_percentage ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="store_logo" class="block font-semibold mb-1">شعار المتجر (اختياري)</label>
            <input type="file" name="store_logo" id="store_logo" class="w-full border rounded p-2">
            @if(!empty($setting->store_logo))
                <img src="{{ asset('storage/' . $setting->store_logo) }}" alt="شعار المتجر" class="mt-2" style="max-height: 100px;">
            @endif
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded">
            حفظ التعديلات
        </button>
    </form>
@endsection
