@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">المستخدمين</h2>

        <table class="min-w-full border border-gray-200">
            <thead>
            <tr>
                <th class="border px-4 py-2">الاسم</th>
                <th class="border px-4 py-2">البريد الإلكتروني</th>
                <th class="border px-4 py-2">الصلاحية</th>
                <th class="border px-4 py-2">الإجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->role ?? 'غير محدد' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600">تعديل</a>
                        |
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mb-4 text-left">
            <a href="{{ route('users.create') }}" class="bg-green-600 text-green-600 px-4 py-2 rounded">إضافة مستخدم جديد</a>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
