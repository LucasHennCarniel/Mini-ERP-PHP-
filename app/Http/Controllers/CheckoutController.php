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
        $frete = 20;
        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15;
        } elseif ($subtotal > 200) {
            $frete = 0;
        }
        $total = $subtotal + $frete;
        return view('checkout.show', compact('cart', 'subtotal', 'frete', 'total'));
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
        $frete = 20;
        if ($subtotal >= 200) {
            $frete = 0;
        } elseif ($subtotal >= 52 && $subtotal < 166.6) {
            $frete = 15;
        }
        $total = $subtotal + $frete;
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
        // Enviar e-mail de confirmação para o e-mail fixo de teste
        \Mail::to('lucashennc@gmail.com')->send(new \App\Mail\PedidoRealizadoMail([
            'nome' => $request->nome,
            'email' => $request->email,
        ], $cart, $subtotal, $frete, $total));
        session()->forget('cart');
        session()->forget('applied_coupon'); // Limpa cupom após finalizar pedido
        return redirect()->route('orders.index')->with('pedido_finalizado', 'Pedido finalizado com sucesso!');
    }
}
