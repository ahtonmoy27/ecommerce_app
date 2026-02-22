@extends('layouts.app')

@section('title', 'Cart - Ecommerce App')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>
    
    @if(count($cartItems) > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="divide-y divide-gray-200">
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php $total += $item['product']['price'] * $item['quantity']; @endphp
                    <div class="p-6 flex items-center space-x-4">
                        <img src="{{ $item['product']['image'] }}" alt="{{ $item['product']['name'] }}" class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $item['product']['name'] }}</h3>
                            <p class="text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-green-600">${{ number_format($item['product']['price'] * $item['quantity'], 2) }}</p>
                            <p class="text-sm text-gray-500">${{ number_format($item['product']['price'], 2) }} each</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-gray-50 p-6">
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-900">Total:</span>
                    <span class="text-2xl font-bold text-green-600">${{ number_format($total, 2) }}</span>
                </div>
                <button class="mt-4 w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition font-semibold">
                    Proceed to Checkout (Demo)
                </button>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Start shopping to add items to your cart!</p>
            <a href="{{ route('products') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition inline-block">
                Browse Products
            </a>
        </div>
    @endif
</div>
@endsection
