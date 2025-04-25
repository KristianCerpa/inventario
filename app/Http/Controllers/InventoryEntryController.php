<?php

namespace App\Http\Controllers;

use App\Models\InventoryEntry;
use Illuminate\Http\Request;

/**
 * Class InventoryEntryController
 * @package App\Http\Controllers
 */
class InventoryEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryEntries = InventoryEntry::paginate(10);

        return view('inventoryentries.index', compact('inventoryEntries'))
            ->with('i', (request()->input('page', 1) - 1) * $inventoryEntries->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventoryEntry = new InventoryEntry();
        return view('inventoryentries.create', compact('inventoryEntry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(InventoryEntry::$rules);

        $inventoryEntry = InventoryEntry::create($request->all());

        return redirect()->route('inventoryentries.index')
            ->with('success', 'InventoryEntry created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventoryEntry = InventoryEntry::find($id);

        return view('inventoryentries.show', compact('inventoryEntry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventoryEntry = InventoryEntry::find($id);

        return view('inventoryentries.edit', compact('inventoryEntry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InventoryEntry $inventoryEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryEntry $inventoryEntry)
    {
        request()->validate(InventoryEntry::$rules);

        $inventoryEntry->update($request->all());

        return redirect()->route('inventoryentries.index')
            ->with('success', 'InventoryEntry updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inventoryEntry = InventoryEntry::find($id)->delete();

        return redirect()->route('inventoryentries.index')
            ->with('success', 'InventoryEntry deleted successfully');
    }
}
