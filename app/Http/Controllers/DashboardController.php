<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalEntries = InventoryMovement::where('type', 'entry')->sum('quantity');
        $totalExits = InventoryMovement::where('type', 'exit')->sum('quantity');
        $recentMovements = InventoryMovement::with('product', 'user')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalEntries',
            'totalExits',
            'recentMovements'
        ));
    }
}
