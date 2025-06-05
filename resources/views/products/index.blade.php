@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Список товаров</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Добавить товар</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ number_format($product->price, 2) }} ₽</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Просмотр</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Редактировать</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection