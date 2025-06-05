@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Создать новый заказ</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">ФИО покупателя</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="mb-3">
            <label for="product_id" class="form-label">Товар</label>
            <select class="form-select" id="product_id" name="product_id" required>
                @foreach($products as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Количество</label>
            <input type="number" min="1" class="form-control" id="quantity" name="quantity" value="1" required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Комментарий</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать заказ</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection