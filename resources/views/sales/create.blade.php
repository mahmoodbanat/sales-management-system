@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white">
        <h1 class="mb-4">إضافة بيع جديد</h1>

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>اسم العميل:</label>
                <input type="text" name="customer_name" class="border rounded px-3 py-2 w-full" >
            </div>

            <div id="products-container">
                <div class="product-row flex gap-2 mb-2">
                    <select name="items[0][product_id]" class="border rounded px-3 py-2 product-select" required>
                        <option value="">اختر المنتج</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} (المتوفر: {{ $product->quantity }})
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][quantity]" placeholder="الكمية" min="1" class="border rounded px-3 py-2 w-24" required>
                    <input type="number" name="items[0][price]" placeholder="السعر" step="0.01" class="border rounded px-3 py-2 w-24" required>
                </div>
            </div>

            <button type="button" id="add-product" class="btn btn-secondary mb-4">+ إضافة منتج آخر</button>

            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>

    <script>
        let index = 1;
        const container = document.getElementById('products-container');

        // إضافة صف منتج جديد
        document.getElementById('add-product').addEventListener('click', function() {
            let html = `
            <div class="product-row flex gap-2 mb-2">
                <select name="items[${index}][product_id]" class="border rounded px-3 py-2 product-select" required>
                    <option value="">اختر المنتج</option>
                    @foreach($products as $product)
            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} (المتوفر: {{ $product->quantity }})
                        </option>
                    @endforeach
            </select>
            <input type="number" name="items[${index}][quantity]" placeholder="الكمية" min="1" class="border rounded px-3 py-2 w-24" required>
                <input type="number" name="items[${index}][price]" placeholder="السعر" step="0.01" class="border rounded px-3 py-2 w-24" required>
            </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            index++;
        });

        // تعبئة السعر تلقائي عند اختيار المنتج
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('product-select')) {
                let price = e.target.selectedOptions[0].getAttribute('data-price');
                let priceInput = e.target.parentElement.querySelector('input[name*="[price]"]');
                priceInput.value = price || '';
            }
        });
    </script>
@endsection
