<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        Order::createNew($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Заказ успешно создан');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        $order->markAsCompleted();
        return redirect()->back()
            ->with('success', 'Заказ помечен как выполненный');
    }
}