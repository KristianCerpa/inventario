<?php

namespace App\Http\Controllers;

use App\Models\Output;
use Illuminate\Http\Request;

/**
 * Class OutputController
 * @package App\Http\Controllers
 */
class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outputs = Output::paginate(10);

        return view('output.index', compact('outputs'))
            ->with('i', (request()->input('page', 1) - 1) * $outputs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $output = new Output();
        return view('output.create', compact('output'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Output::$rules);

        $output = Output::create($request->all());

        return redirect()->route('outputs.index')
            ->with('success', 'Output created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $output = Output::find($id);

        return view('output.show', compact('output'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $output = Output::find($id);

        return view('output.edit', compact('output'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Output $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        request()->validate(Output::$rules);

        $output->update($request->all());

        return redirect()->route('outputs.index')
            ->with('success', 'Output updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $output = Output::find($id)->delete();

        return redirect()->route('outputs.index')
            ->with('success', 'Output deleted successfully');
    }
}
