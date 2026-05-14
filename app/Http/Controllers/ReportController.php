<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function invoice()
    {
        return view('reports.invoice');
    }

    public function generatePDF(Request $request)
    {
        $validated = $request->validate([
            'period' => 'required|in:day,month,year',
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($validated['date']);

        $query = InventoryMovement::with('product', 'user');

        switch ($validated['period']) {
            case 'day':
                $query->whereDate('created_at', $date);
                $label = 'Día: ' . $date->format('d/m/Y');
                break;
            case 'month':
                $query->whereMonth('created_at', $date->month)
                      ->whereYear('created_at', $date->year);
                $label = 'Mes: ' . $date->format('m/Y');
                break;
            case 'year':
                $query->whereYear('created_at', $date->year);
                $label = 'Año: ' . $date->year;
                break;
        }

        $movements = $query->latest()->get();
        $totalEntries = $movements->where('type', 'entry')->sum('quantity');
        $totalExits = $movements->where('type', 'exit')->sum('quantity');

        $pdf = Pdf::loadView('reports.invoice-pdf', compact(
            'movements', 'label', 'totalEntries', 'totalExits', 'date', 'validated'
        ));

        return $pdf->download('reporte-' . $date->format('Y-m-d') . '.pdf');
    }
}
