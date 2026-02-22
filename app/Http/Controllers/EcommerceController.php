<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcommerceController extends Controller
{
    /**
     * Home page.
     */
    public function home()
    {
        $products = $this->getSampleProducts();
        
        return view('home', [
            'products' => $products,
        ]);
    }

    /**
     * Dashboard for authenticated users.
     */
    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user(),
            'products' => $this->getSampleProducts(),
        ]);
    }

    /**
     * Product listing page.
     */
    public function products()
    {
        return view('products', [
            'products' => $this->getSampleProducts(),
        ]);
    }

    /**
     * Cart page.
     */
    public function cart()
    {
        return view('cart', [
            'cartItems' => session('cart', []),
        ]);
    }

    /**
     * Add to cart.
     */
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $products = collect($this->getSampleProducts());
        $product = $products->firstWhere('id', $productId);

        if ($product) {
            $cart = session('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'product' => $product,
                    'quantity' => 1,
                ];
            }
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Product added to cart!');
    }

    /**
     * Get sample products.
     */
    private function getSampleProducts(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Wireless Headphones',
                'price' => 79.99,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300',
                'description' => 'High-quality wireless headphones with noise cancellation.',
            ],
            [
                'id' => 2,
                'name' => 'Smart Watch',
                'price' => 199.99,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300',
                'description' => 'Feature-rich smartwatch with health tracking.',
            ],
            [
                'id' => 3,
                'name' => 'Laptop Backpack',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300',
                'description' => 'Durable laptop backpack with multiple compartments.',
            ],
            [
                'id' => 4,
                'name' => 'Bluetooth Speaker',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=300',
                'description' => 'Portable Bluetooth speaker with amazing sound.',
            ],
            [
                'id' => 5,
                'name' => 'USB-C Hub',
                'price' => 39.99,
                'image' => 'https://images.unsplash.com/photo-1625723044792-44de16ccb4e9?w=300',
                'description' => 'Multi-port USB-C hub for all your connectivity needs.',
            ],
            [
                'id' => 6,
                'name' => 'Mechanical Keyboard',
                'price' => 129.99,
                'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=300',
                'description' => 'RGB mechanical keyboard with custom switches.',
            ],
        ];
    }
}
