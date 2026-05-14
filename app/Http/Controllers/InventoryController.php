<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function movements(): View
    {
        $movements = InventoryMovement::with('product', 'user')
            ->latest()
            ->paginate(15);

        return view('inventory.movements.index', compact('movements'));
    }

    public function createMovement(): View
    {
        $products = Product::orderBy('name')->get();
        return view('inventory.movements.create', compact('products'));
    }

    public function storeMovement(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entry,exit',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = auth()->id();

        if ($validated['type'] === 'exit') {
            $product = Product::findOrFail($validated['product_id']);
            $stock = $product->stock;
            if ($stock < $validated['quantity']) {
                return back()->withErrors([
                    'quantity' => 'Stock insuficiente. Stock actual: ' . $stock
                ])->withInput();
            }
        }

        InventoryMovement::create($validated);

        return redirect()->route('inventory.movements')
            ->with('success', 'Movimiento registrado exitosamente.');
    }

    public function editMovement(InventoryMovement $movement): View
    {
        $products = Product::orderBy('name')->get();
        return view('inventory.movements.edit', compact('movement', 'products'));
    }

    public function updateMovement(Request $request, InventoryMovement $movement): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entry,exit',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validated['type'] === 'exit') {
            $product = Product::findOrFail($validated['product_id']);
            $stock = $product->stock;
            $adjustedStock = $stock + ($movement->type === 'exit' ? $movement->quantity : 0);
            if ($adjustedStock < $validated['quantity']) {
                return back()->withErrors([
                    'quantity' => 'Stock insuficiente. Stock actual: ' . $adjustedStock
                ])->withInput();
            }
        }

        $movement->update($validated);

        return redirect()->route('inventory.movements')
            ->with('success', 'Movimiento actualizado exitosamente.');
    }

    public function destroyMovement(InventoryMovement $movement): RedirectResponse
    {
        $movement->delete();

        return redirect()->route('inventory.movements')
            ->with('success', 'Movimiento eliminado exitosamente.');
    }

    public function stock(Request $request): View
    {
        $query = Product::addSelect([
            'stock' => InventoryMovement::selectRaw(
                'COALESCE(SUM(CASE WHEN type = "entry" THEN quantity ELSE 0 END), 0) -
                 COALESCE(SUM(CASE WHEN type = "exit" THEN quantity ELSE 0 END), 0)'
            )->whereColumn('product_id', 'products.id'),
        ]);

        $sort = $request->get('sort', 'desc');
        $query->orderBy('created_at', $sort);

        $search = $request->get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(10)->withQueryString();

        return view('inventory.stock', compact('products', 'sort', 'search'));
    }
}
