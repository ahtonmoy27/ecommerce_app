@extends('layouts.app')

@section('title', 'Ecommerce App - Home')

@section('content')
<!-- Hero Section -->
<div class="gradient-bg text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Ecommerce App</h1>
        <p class="text-xl text-white/80 mb-8">Shop the best products with Single Sign-On authentication</p>
        @guest
            <a href="{{ route('login') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login with SSO
            </a>
            <p class="mt-4 text-sm text-white/60">Already logged in to Auth Server? You'll be automatically authenticated!</p>
        @else
            <a href="{{ route('dashboard') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                Go to Dashboard
            </a>
        @endguest
    </div>
</div>

<!-- SSO Info Banner -->
<div class="bg-blue-50 border-b border-blue-200">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-center space-x-2 text-blue-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>This app uses SSO authentication. Login once at the Auth Server and access both Ecommerce and Foodpanda!</span>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Featured Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $product['name'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $product['description'] }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-green-600">${{ number_format($product['price'], 2) }}</span>
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                Login to Buy
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Switch to Foodpanda Banner -->
<div class="bg-pink-50 border-t border-pink-200">
    <div class="max-w-7xl mx-auto px-4 py-8 text-center">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Hungry? Try Foodpanda!</h3>
        <p class="text-gray-600 mb-4">Already logged in here? You'll be automatically logged in to Foodpanda too!</p>
        <a href="http://localhost:8002" target="_blank" class="inline-flex items-center bg-pink-600 text-white px-6 py-3 rounded-lg hover:bg-pink-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            Go to Foodpanda
        </a>
    </div>
</div>
@endsection
