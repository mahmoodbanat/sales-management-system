@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">لوحة التحكم</h1>

        {{-- كروت الإحصائيات --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h2 class="text-gray-500">عدد المنتجات</h2>
                <p class="text-3xl font-bold text-blue-500">{{ $totalProducts }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h2 class="text-gray-500">عدد المبيعات</h2>
                <p class="text-3xl font-bold text-green-500">{{ $totalSales }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h2 class="text-gray-500">عدد المستخدمين</h2>
                <p class="text-3xl font-bold text-purple-500">{{ $totalUsers }}</p>
            </div>
        </div>

        {{-- الرسم البياني للمبيعات --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-gray-700 font-bold mb-4">المبيعات في آخر 7 أيام</h2>
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>

    {{-- مكتبة Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'المبيعات',
                    data: {!! json_encode($totals) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection
