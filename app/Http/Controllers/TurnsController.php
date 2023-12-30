<?php

namespace App\Http\Controllers;

use App\Models\Turns;
use App\Http\Requests\StoreTurnsRequest;
use App\Http\Requests\UpdateTurnsRequest;

use Inertia\Inertia;

class TurnsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turns = Turns::with('movies')->paginate(25);
        return Inertia::render('Turns/Index', ['turns' => $turns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se usa la misma vista para crear los registros
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTurnsRequest $request)
    {
        // La entrada de datos se valida en StoreTurnsRequest para respetar 
        // el principio SOLID de Single Responsability
        $turn = new Turns($request->validated());
        $turn->save();
        return redirect('turns');
    }

    /**
     * Display the specified resource.
     */
    public function show(Turns $turns)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turns $turns)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTurnsRequest $request, $id)
    {
        // La entrada de datos se valida en UpdateTurnsRequest para respetar 
        // el principio SOLID de Single Responsability
        $turn = Turns::find($id);
        $turn->fill($request->validated())->saveOrFail();
        return redirect('turns');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $turn = Turns::find($id);
        $turn->delete();
        return redirect('turns');
    }
}
