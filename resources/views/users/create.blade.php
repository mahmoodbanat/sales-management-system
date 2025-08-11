@extends('layouts.app')

@section('content')
    <div class="p-6 ">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إضافة مستخدم جديد
        </h2>
    </div>

    <div class="p-6 bg-white rounded shadow max-w-xl mx-auto mt-6">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-1">الاسم</label>
                <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1">كلمة المرور</label>
                <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-blue-500 px-4 py-2 rounded">حفظ</button>
            </div>
        </form>
    </div>
        @endsection
