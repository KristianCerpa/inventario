<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Product; // Importa el modelo Product
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class EntryController
 * @package App\Http\Controllers
 */
class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::paginate(10);

        return view('entry.index', compact('entries'))
            ->with('i', (request()->input('page', 1) - 1) * $entries->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $entry = new Entry();
        // Obtener todos los productos para el select.  Utiliza el modelo Product.
        $products = Product::all()->pluck('nombre', 'id');
        $types = ['compra' => 'Compra', 'devolucion' => 'Devolución'];

        return view('entry.create', compact('entry', 'products', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Entry::$rules);

        $entry = Entry::create($request->all());

        return redirect()->route('entries.index')
            ->with('success', 'Entry created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = Entry::find($id);

        return view('entry.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $entry = Entry::find($id);
        // Obtener todos los productos para el select. Utiliza el modelo Product.
        $products = Product::all()->pluck('nombre', 'id');
        $types = ['compra' => 'Compra', 'devolucion' => 'Devolución'];

        return view('entry.edit', compact('entry', 'products', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Entry $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        request()->validate(Entry::$rules);

        $entry->update($request->all());

        return redirect()->route('entries.index')
            ->with('success', 'Entry updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $entry = Entry::find($id)->delete();

        return redirect()->route('entries.index')
            ->with('success', 'Entry deleted successfully');
    }
}


