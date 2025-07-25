<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with(['product', 'variation'])->get();
        return view('stocks.index', compact('stocks'));
    }

    public function destroy($id)
    {
        $stock = \App\Models\Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Estoque excluído com sucesso.');
    }
}