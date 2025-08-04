<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Mail\PedidoRealizadoMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(function($item) {
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
            if (isset($appliedCoupon['discount'])) {
                if (strpos($appliedCoupon['discount'], '%') !== false) {
                    $percent = floatval(str_replace('%', '', $appliedCoupon['discount']));
                    $discount = ($subtotal * $percent) / 100;
                } else {
                    $discount = floatval($appliedCoupon['discount']);
                }
                $discount = min($discount, $subtotal);
            }
        }
        $total = $subtotal + $frete - $discount;
        return view('checkout.show', compact('cart', 'subtotal', 'frete', 'discount', 'total', 'couponCode'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
        ]);
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Carrinho vazio!');
        }
        $subtotal = collect($cart)->sum(function($item) {
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
        if ($appliedCoupon) {
            if (isset($appliedCoupon['discount'])) {
                if (strpos($appliedCoupon['discount'], '%') !== false) {
                    $percent = floatval(str_replace('%', '', $appliedCoupon['discount']));
                    $discount = ($subtotal * $percent) / 100;
                } else {
                    $discount = floatval($appliedCoupon['discount']);
                }
                $discount = min($discount, $subtotal);
            }
        }
        $total = $subtotal + $frete - $discount;
        // Validação de estoque
        foreach ($cart as $item) {
            $productId = $item['product_id'] ?? null;
            $variationId = $item['variation_id'] ?? null;
            $stock = \App\Models\Stock::where('product_id', $productId)
                ->where('variation_id', $variationId)
                ->first();
            if (!$stock || $stock->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Estoque insuficiente para ' . $item['name']);
            }
        }
        // Salvar pedido e descontar estoque
        $order = \App\Models\Order::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'subtotal' => $subtotal,
            'freight' => $frete,
            'total' => $total,
        ]);
        foreach ($cart as $item) {
            $order->products()->attach($item['product_id'], [
                'variation_id' => $item['variation_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            $stock = \App\Models\Stock::where('product_id', $item['product_id'])
                ->where('variation_id', $item['variation_id'] ?? null)
                ->first();
            $stock->quantity -= $item['quantity'];
            $stock->save();
        }
        // Enviar e-mail de confirmação para o e-mail do cliente
        try {
            \Mail::to($request->email)->send(new \App\Mail\PedidoRealizadoMail(
                $pedido, $cart, $subtotal, $frete, $total
            ));
        } catch (\Exception $e) {
            // Você pode logar o erro ou exibir uma mensagem amigável se quiser
            // \Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
        }
        session()->forget('cart');
        session()->forget('applied_coupon'); // Limpa cupom após finalizar pedido
        return redirect()->route('orders.success');
    }

    public function success()
    {
        return view('orders.success');
    }
}
