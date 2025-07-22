<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
        $frete = 20;
        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15;
        } elseif ($subtotal > 200) {
            $frete = 0;
        }
        $total = $subtotal + $frete;
        return view('cart.index', compact('cart', 'subtotal', 'frete', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $variation = $request->variation_id ? Variation::find($request->variation_id) : null;
        $cart = session('cart', []);
        $key = $product->id . '-' . ($variation ? $variation->id : '0');
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'variation_id' => $variation ? $variation->id : null,
                'name' => $product->name . ($variation ? ' - ' . $variation->name : ''),
                'price' => $product->price,
                'quantity' => $request->quantity,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function remove($key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
