<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Realiza la búsqueda de las evidencias que coincidan con el campo "Nombre" o el campo "usuario"
        $evidencias = Evidencia::where('estado', 'nuevo')
                                ->where(function ($queryBuilder) use ($query) {
                                    $queryBuilder->where('user', function ($subQueryBuilder) use ($query) {
                                                     $subQueryBuilder->where('name', 'LIKE', "%$query%");
                                                 });
                                })
                                ->paginate();
    
        $i = ($evidencias->currentPage() - 1) * $evidencias->perPage();
    
        return view('user.index', compact('evidencias', 'i'));
    }
        
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|confirmed'
        ]);

        $user = User::create(request(['name', 'email', 'password']));
        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
    
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'Usuario modificado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }


}
