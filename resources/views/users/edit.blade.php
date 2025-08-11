@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">تعديل مستخدم</h2>
    </div>
    <div class="p-6 bg-white">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name">الاسم</label>
                <input type="text" name="name" value="{{ $user->name }}" class="border rounded p-2 w-full">
            </div>

            <div class="mb-4">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ $user->email }}" class="border rounded p-2 w-full">
            </div>

            <div class="mb-4">
                <label for="password">كلمة المرور (اتركه فارغ إذا لا تريد التغيير)</label>
                <input type="password" name="password" class="border rounded p-2 w-full">
            </div>

            <button type="submit" class="bg-blue-600 text-green-600 px-4 py-2 rounded">تعديل</button>
        </form>
    </div>
@endsection
