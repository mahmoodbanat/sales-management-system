@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            لوحة التحكم
        </h2>
    </div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold">مرحبًا يا {{ Auth::user()->name }}</h1>
                <p class="mt-4 text-gray-700">دي لوحة التحكم الخاصة بك، هنبدأ نضيف فيها الأقسام قريبًا.</p>
            </div>
        </div>
    </div>
@endsection
