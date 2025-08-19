@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>تعديل بيانات البيع</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>خطأ!</strong> يرجى تصحيح الأخطاء التالية:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.update', $sale->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>اسم المنتج</label>
                <input type="text" name="product_name" value="{{ old('product_name', $sale->product_name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>اسم العميل</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $sale->customer_name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>التاريخ</label>
                <input type="date" name="date" id="date" value="{{ old('date', $sale->date) }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label>الكمية</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $sale->quantity) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>السعر</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $sale->price) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>الإجمالي</label>
                <input type="number" step="0.01" name="total" id="total" value="{{ old('total', $sale->total) }}" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ضبط التاريخ الحالي تلقائياً لو فارغ
            let dateInput = document.getElementById('date');
            if (!dateInput.value) {
                let today = new Date().toISOString().split('T')[0];
                dateInput.value = today;
            }

            // حساب الإجمالي تلقائياً
            document.getElementById('quantity').addEventListener('input', calculateTotal);
            document.getElementById('price').addEventListener('input', calculateTotal);

            function calculateTotal() {
                let quantity = parseFloat(document.getElementById('quantity').value) || 0;
                let price = parseFloat(document.getElementById('price').value) || 0;
                document.getElementById('total').value = (quantity * price).toFixed(2);
            }

            // حساب الإجمالي عند تحميل الصفحة
            calculateTotal();
        });
    </script>
@endsection
