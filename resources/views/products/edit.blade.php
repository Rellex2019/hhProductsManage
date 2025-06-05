@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Редактировать товар</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id" required>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection