@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>Список заказов</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Создать заказ</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Дата создания</th>
                <th>Покупатель</th>
                <th>Статус</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ number_format($order->product->price * $order->quantity, 2) }} ₽</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-info btn-sm">Просмотр</a>
                    @if($order->status == 'новый')
                    <form action="{{ route('orders.complete', $order) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Завершить</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection