@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>إضافة بيع جديد</h1>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="customer_name" class="form-label">اسم العميل</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">التاريخ</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">المجموع</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
@endsection
