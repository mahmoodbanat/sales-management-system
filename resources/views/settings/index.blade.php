{{-- resources/views/settings/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">الإعدادات العامة للنظام</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">اسم المتجر</label>
                <input type="text" name="store_name" class="w-full border rounded p-2"
                       value="{{ old('store_name', $settings->store_name ?? '') }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">العملة</label>
                <input type="text" name="currency" class="w-full border rounded p-2"
                       value="{{ old('currency', $settings->currency ?? '') }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">نسبة الضريبة (%)</label>
                <input type="number" step="0.01" name="tax_rate" class="w-full border rounded p-2"
                       value="{{ old('tax_rate', $settings->tax_rate ?? '') }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">رقم الهاتف</label>
                <input type="text" name="phone" class="w-full border rounded p-2"
                       value="{{ old('phone', $settings->phone ?? '') }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" class="w-full border rounded p-2"
                       value="{{ old('email', $settings->email ?? '') }}">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">العنوان</label>
                <textarea name="address" class="w-full border rounded p-2">{{ old('address', $settings->address ?? '') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded">
                حفظ الإعدادات
            </button>
            <a href="{{ route('settings.edit') }}" class="btn btn-primary">تعديل الإعدادات</a>

        </form>
    </div>
@endsection

