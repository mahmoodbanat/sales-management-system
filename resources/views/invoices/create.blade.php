@extends('layouts.app')

@section('content')
    <div class="py-6 px-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            إنشاء فاتورة جديدة
        </h2>

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="customer_name" class="block text-sm font-medium">اسم العميل (اختياري):</label>
                <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full border rounded px-3 py-2">
            </div>

            <div id="invoice-items">
                <div class="item mb-4 border p-4 rounded">
                    <label>اختر المنتج:</label>
                    <select name="items[0][product_id]" class="w-full border rounded px-2 py-1">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} ({{ $product->price }} جنيه)
                            </option>
                        @endforeach
                    </select>

                    <label class="block mt-2">الكمية:</label>
                    <input type="number" name="items[0][quantity]" class="w-full border rounded px-2 py-1" value="1">
                </div>
            </div>

            <button type="button" id="add-item" class="bg-blue-500 text-black px-4 py-2 rounded">+ إضافة منتج</button>

            <div class="mt-4">
                <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded">حفظ الفاتورة</button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1;
        document.getElementById('add-item').addEventListener('click', function () {
            const container = document.getElementById('invoice-items');
            const newItem = document.querySelector('.item').cloneNode(true);

            newItem.querySelectorAll('select, input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\d+/, itemIndex);
                    el.setAttribute('name', newName);
                }
                if (el.tagName === 'INPUT') el.value = 1;
            });

            container.appendChild(newItem);
            itemIndex++;
        });
    </script>
@endsection
