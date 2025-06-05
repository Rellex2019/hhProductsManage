@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Информация о заказе #{{ $order->id }}</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Заказ от {{ $order->created_at->format('d.m.Y H:i') }}</h5>
            <p class="card-text"><strong>Покупатель:</strong> {{ $order->customer_name }}</p>
            <p class="card-text"><strong>Статус:</strong> {{ $order->status }}</p>
            <p class="card-text"><strong>Товар:</strong> {{ $order->product->name }}</p>
            <p class="card-text"><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p class="card-text"><strong>Цена за единицу:</strong> {{ number_format($order->product->price, 2) }} ₽</p>
            <p class="card-text"><strong>Итого:</strong> {{ number_format($order->product->price * $order->quantity, 2) }} ₽</p>
            <p class="card-text"><strong>Комментарий:</strong> {{ $order->comment ?? 'нет' }}</p>
            
            @if($order->status == 'новый')
            <form action="{{ route('orders.complete', $order) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Завершить заказ</button>
            </form>
            @endif
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад</a>
        </div>
    </div>
</div>
@endsection