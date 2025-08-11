<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'نظام المبيعات' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-whit text-gray-900">

<!-- القائمة العلوية -->
<nav class="bg-purple-600 text-black  shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- اسم النظام -->
            <div class="flex-shrink-0 text-lg font-bold">
                نظام المبيعات
            </div>

            <!-- الروابط -->
            <div class="flex space-x-4 space-x-reverse">
                <a href="{{ route('products.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">المنتجات</a>
                <a href="{{ route('sales.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">المبيعات</a>
                <a href="{{ route('invoices.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">الفواتير</a>
                <a href="{{ route('reports.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">التقارير</a>
                <a href="{{ route('users.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">المستخدمين</a>
                <a href="{{ route('settings.index') }}" class="hover:bg-purple-700 px-3 py-2 rounded">الإعدادات</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:bg-purple-700 px-3 py-2 rounded">تسجيل الخروج</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- محتوى الصفحات -->
<div class="max-w-7xl mx-auto mt-6 px-4">
    @yield('content')
</div>

</body>
</html>
