<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variation;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variations')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Cria/atualiza estoque principal na tabela stocks
        Stock::updateOrCreate(
            ['product_id' => $product->id, 'variation_id' => null],
            ['quantity' => $request->stock]
        );

        // Variações são opcionais
        if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                if (!empty($variation['name'])) {
                    $v = $product->variations()->create([
                        'name' => $variation['name'],
                        'stock' => $variation['stock'] ?? 0,
                    ]);
                    // Cria estoque para variação
                    Stock::updateOrCreate(
                        ['product_id' => $product->id, 'variation_id' => $v->id],
                        ['quantity' => $variation['stock'] ?? 0]
                    );
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // Atualiza estoque principal na tabela stocks
        Stock::updateOrCreate(
            ['product_id' => $product->id, 'variation_id' => null],
            ['quantity' => $request->stock]
        );

        // Remove e recria as variações e seus estoques
        foreach ($product->variations as $variation) {
            Stock::where('variation_id', $variation->id)->delete();
        }
        $product->variations()->delete();
        if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                if (!empty($variation['name'])) {
                    $v = $product->variations()->create([
                        'name' => $variation['name'],
                        'stock' => $variation['stock'] ?? 0,
                    ]);
                    // Cria estoque para variação
                    Stock::updateOrCreate(
                        ['product_id' => $product->id, 'variation_id' => $v->id],
                        ['quantity' => $variation['stock'] ?? 0]
                    );
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto removido!');
    }
}