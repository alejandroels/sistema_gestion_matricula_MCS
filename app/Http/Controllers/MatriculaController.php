<?php

namespace App\Http\Controllers;

use App\Matricula;
use Illuminate\Http\Request;
use App\Evidencia;


/**
 * Class MatriculaController
 * @package App\Http\Controllers
 */
class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matriculas = Matricula::with('evidencia')->with('user')->paginate();

        $i = ($matriculas->currentPage() - 1) * $matriculas->perPage();

        return view('matricula.index', compact('matriculas', 'i'));    
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $matriculas = Evidencia::with('user')->where(function ($queryBuilder) use ($query) {
                                    $queryBuilder->where('Nombre', 'LIKE', "%$query%")
                                                 ->orWhereHas('user', function ($subQueryBuilder) use ($query) {
                                                     $subQueryBuilder->where('name', 'LIKE', "%$query%");
                                                 });
                                })
                                ->paginate();
    
        $i = ($matriculas->currentPage() - 1) * $matriculas->perPage();
    
        return view('matricula.index', compact('matriculas', 'i'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $evidencia = new Matricula();
    //     return view('matricula.create', compact('matricula'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_evidencia)
{
    $matricula = new Matricula();
    $matricula->evidencia_id = $id_evidencia;
    $matricula->estado = 'matriculado';
    $matricula->save();

    $evidencia = Evidencia::find($id_evidencia);

    if ($evidencia) {
        $evidencia->Estado = 'aceptada';
        $evidencia->save();
    }   

    return redirect()->route('evidencia.requests')
        ->with('success', 'Matricula creada correctamente');
}
        

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    // public function show($id)
    // {
    //     $matricula = Matricula::find($id);

    //     return view('matricula.show', compact('matricula'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matricula = Matricula::find($id);

        return view('matricula.edit', compact('matricula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Matricula $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricula $matricula)
    {
        // request()->validate(Matricula::$rules);
    
        $matricula->NoRegistro = $request->input('NoRegistro');
        $matricula->AreaTrabajo = $request->input('AreaTrabajo');
        $matricula->FechaInicio = $request->input('FechaInicio');
        $matricula->FechaFin = $request->input('FechaFin');
        $matricula->save();
    
        if ($matricula->wasChanged()) {
            return redirect()->route('matriculas.index')
                ->with('success', 'Matricula modificada correctamente');
        } else {
            return redirect()->route('matriculas.edit')
                ->with('warning', 'No se ha realizado ninguna modificación en la matrícula');
        }
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $matricula = Matricula::find($id)->delete();

        return redirect()->route('matriculas.index')
            ->with('success', 'Matricula eliminada correctamente');
    }

    public function darBaja($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->estado = 'Baja';
        $matricula->save();
    
        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula dada de baja exitosamente');
    }
    
}
