<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

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
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ]);
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Carrinho vazio!');
        }
        // Validação de estoque
        foreach ($cart as $item) {
            $stock = Stock::where('product_id', $item['product_id'])
                ->where('variation_id', $item['variation_id'])
                ->first();
            if (!$stock || $stock->quantity < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', 'Estoque insuficiente para ' . $item['name']);
            }
        }
        // Salvar pedido e descontar estoque
        DB::transaction(function() use ($request, $cart) {
            $order = Order::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'total' => $request->total,
            ]);
            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'variation_id' => $item['variation_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                $stock = Stock::where('product_id', $item['product_id'])
                    ->where('variation_id', $item['variation_id'])
                    ->first();
                $stock->quantity -= $item['quantity'];
                $stock->save();
            }
        });
        session()->forget('cart');
        return redirect()->route('products.index')->with('pedido_finalizado', 'Pedido finalizado com sucesso!');
    }
}
