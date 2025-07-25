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
        // Filtra apenas arrays válidos (evita erro de tipo caso haja string ou valor antigo)
        $cart = array_filter($cart, 'is_array');
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $subtotal = round((float)$subtotal, 2);
        if ($subtotal >= 200) {
            $frete = 0;
        } elseif ($subtotal >= 52) {
            $frete = 15;
        } else {
            $frete = 20;
        }
        // Lógica de cupom
        $appliedCoupon = session('applied_coupon');
        $discount = 0;
        $couponCode = null;
        if ($appliedCoupon) {
            $couponCode = $appliedCoupon['code'] ?? null;
            // Suporte a desconto percentual e fixo
            if (isset($appliedCoupon['discount'])) {
                if (strpos($appliedCoupon['discount'], '%') !== false) {
                    // Exemplo: "10%"
                    $percent = floatval(str_replace('%', '', $appliedCoupon['discount']));
                    $discount = ($subtotal * $percent) / 100;
                } else {
                    $discount = floatval($appliedCoupon['discount']);
                }
                // Não deixa desconto maior que o subtotal
                $discount = min($discount, $subtotal);
            }
        }
        $total = $subtotal + $frete - $discount;
        return view('cart.index', compact('cart', 'subtotal', 'frete', 'discount', 'total', 'couponCode'));
    }

    public function add(Request $request)
    {
        $cart = session('cart', []);
        // Filtra apenas arrays válidos (evita erro de tipo caso haja string ou valor antigo)
        $cart = array_filter($cart, 'is_array');
        $productId = $request->input('product_id');
        if ($productId) {
            $product = Product::find($productId);
            if ($product) {
                // Busca se já existe no carrinho
                $found = false;
                foreach ($cart as &$item) {
                    if (isset($item['product_id']) && $item['product_id'] == $productId) {
                        $item['quantity'] += 1;
                        $found = true;
                        break;
                    }
                }
                unset($item);
                if (!$found) {
                    $cart[] = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1
                    ];
                }
            }
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
        session()->forget('applied_coupon'); // Limpa cupom ao esvaziar carrinho
        return redirect()->route('cart.index');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);
        $coupon = \App\Models\Coupon::where('code', $request->coupon_code)->first();
        if ($coupon) {
            session(['applied_coupon' => $coupon->toArray()]);
            return redirect()->back()->with('success', 'Cupom aplicado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Cupom inválido ou não encontrado.');
        }
    }
}
