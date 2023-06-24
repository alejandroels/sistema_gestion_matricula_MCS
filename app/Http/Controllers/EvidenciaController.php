<?php

namespace App\Http\Controllers;

use App\Evidencia;
use App\Matricula;
use\App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class EvidenciaController
 * @package App\Http\Controllers
 */
class EvidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        $evidencias = Evidencia::where('estado', 'nuevo')->with('user')->paginate();
        $i = ($evidencias->currentPage() - 1) * $evidencias->perPage();

        return view('evidencia.index', compact('evidencias'))
            ->with('i', (request()->input('page', 1) - 1) * $evidencias->perPage());
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Realiza la búsqueda de las evidencias que coincidan con el campo "Nombre" o el campo "usuario"
        $evidencias = Evidencia::where('estado', 'nuevo')
                                ->where(function ($queryBuilder) use ($query) {
                                    $queryBuilder->where('Nombre', 'LIKE', "%$query%")
                                                 ->orWhereHas('user', function ($subQueryBuilder) use ($query) {
                                                     $subQueryBuilder->where('name', 'LIKE', "%$query%");
                                                 });
                                })
                                ->paginate();
    
        $i = ($evidencias->currentPage() - 1) * $evidencias->perPage();
    
        return view('evidencia.index', compact('evidencias', 'i'));
    }
    
    public function searchRequests(Request $request)
    {
        $query = $request->input('query');
    
        // Realiza la búsqueda de las evidencias que coincidan con el campo "Nombre" o el campo "usuario"
        $evidencias = Evidencia::where('estado', 'solicitud')
                                ->where(function ($queryBuilder) use ($query) {
                                    $queryBuilder->where('Nombre', 'LIKE', "%$query%")
                                                 ->orWhereHas('user', function ($subQueryBuilder) use ($query) {
                                                     $subQueryBuilder->where('name', 'LIKE', "%$query%");
                                                 });
                                })
                                ->paginate();
    
        $i = ($evidencias->currentPage() - 1) * $evidencias->perPage();
    
        return view('evidencia.requests', compact('evidencias', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evidencia = new Evidencia();
        return view('evidencia.create', compact('evidencia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
    {
        
        request()->validate(Evidencia::$rules);

        $user_id = auth()->user()->id;
        

        $evidencia = new Evidencia(); // Crea una nueva instancia del modelo Evidencia
        

        $data = array_merge($request->all(), ['user_id' => $user_id]);
       
        if($request->hasFile('FotocopiaTitulo')){
            $data['FotocopiaTitulo']=$request->file('FotocopiaTitulo')->store('uploads','public');
        }
        if($request->hasFile('ActaSolicitud')){
            $data['ActaSolicitud']=$request->file('ActaSolicitud')->store('uploads','public');
        } 


        $evidencia = Evidencia::create($data);

        $evidencia->save();

        return redirect()->route('evidencia.showByUser', ['user_id' => $user_id])
        ->with('success', 'Evidencia creada correctamente');
            }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evidencia = Evidencia::find($id);

        return view('evidencia.show', compact('evidencia'));
    }

    // public function showByUser($user_id)
    // {
    //     $evidencia = Evidencia::where('user_id', $user_id)->first();

    //     return view('evidencia.show', compact('evidencia'));
    // }

    public function showByUser($user_id)
{
    $evidencia = Evidencia::where('user_id', $user_id)->first();


    return view('evidencia.show', compact('evidencia'));
}

public function status($user_id)
{
    $evidencia = Evidencia::where('user_id', $user_id)->first();

    if ($evidencia) {
        return view('evidencia.status', compact('evidencia'));
    } else {
        return view('evidencia.status')->with('message', 'No se encontraron evidencias para el usuario.');
    }
}

    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
{
    $evidencia = Evidencia::where('user_id', $user_id)->first();

    if (!$evidencia) {
        return redirect()->route('evidencias.index')->with('error', 'Evidencia not found');
    }

    return view('evidencia.edit', compact('evidencia'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evidencia $evidencia)
    {
        request()->validate(Evidencia::$rules);


        $evidencia->fill($request->all());
        

        if($request->hasFile('FotocopiaTitulo')){
            $evidencia['FotocopiaTitulo']=$request->file('FotocopiaTitulo')->store('uploads','public');
        }
        if($request->hasFile('ActaSolicitud')){
            $evidencia['ActaSolicitud']=$request->file('ActaSolicitud')->store('uploads','public');
        } 

        $evidencia->save();


        return redirect()->route('evidencia.showByUser', ['user_id' => auth()->user()->id])
                    ->with('success', 'Evidencia modificada correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($user_id)
    {
        $evidencia = Evidencia::where('user_id', $user_id)->first();
        
        if ($evidencia) {
            $evidencia->delete();
            return redirect()->to('/')->with('success', 'Evidencia eliminada correctamente');
        } else {
            return redirect()->to('/')->with('error', 'Evidencia no encontrada');
        }
    }

    public function accept($evidencia_id)
{
    $evidencia = Evidencia::find($evidencia_id);

    if ($evidencia) {
        $evidencia->Estado = 'solicitud';
        $evidencia->save();

        return redirect()->route('evidencias.index')->with('success', 'Estado de Evidencia actualizado correctamente');
    }

    return redirect()->route('evidencias.index')->with('error', 'Evidencia no encontrada');
}

public function rectific($evidencia_id)
{
    $evidencia = Evidencia::find($evidencia_id);

    if ($evidencia) {
        $evidencia->Estado = 'rectificar';
        $evidencia->save();

        return redirect()->route('evidencias.index')->with('success', 'Estado de Evidencia actualizado correctamente');
    }

    return redirect()->route('evidencias.index')->with('error', 'Evidencia no encontrada');
}

public function deny($evidencia_id)
{
    $evidencia = Evidencia::find($evidencia_id);

    if ($evidencia) {
        $evidencia->Estado = 'denegada';
        $evidencia->save();

        return redirect()->route('evidencias.requests')->with('success', 'Estado de Evidencia actualizado correctamente');
    }

    return redirect()->route('evidencias.index')->with('error', 'Evidencia no encontrada');
}


public function createMatricula($evidencia_id)
    {
        // Obtener la evidencia correspondiente al ID proporcionado
        $evidencia = Evidencia::findOrFail($evidencia_id);

        $matricula = new Matricula();
        $matricula->evidencia_id = $evidencia_id;
        $matricula->estado = 'matriculado';
        $matricula->save();
    
        $evidencia = Evidencia::find($evidencia_id);
    
        if ($evidencia) {
            $evidencia->Estado = 'aceptada';
            $evidencia->save();
        }   


        // Redirigir al método index del controlador EvidenciaController
        return redirect()->route('evidencias.index')->with('success', 'Matrícula creada exitosamente.');
    }




public function requests()
    {
    
            $evidencias = Evidencia::where('estado', 'solicitud')->paginate();
            $i = ($evidencias->currentPage() - 1) * $evidencias->perPage();
    
            return view('evidencia.requests', compact('evidencias'))
                ->with('i', (request()->input('page', 1) - 1) * $evidencias->perPage());
        
    }  
}

