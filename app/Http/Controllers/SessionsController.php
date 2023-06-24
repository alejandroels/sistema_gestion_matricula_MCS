<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    public function create(){

        return view('auth.login');
    }

    public function store(){

        // if(auth()->attempt(request(['email','password'])) == false){
        //     return back()->withErrors([
        //         'message'=> 'Campos incorrectos o vacios'
        //     ]);

        $email = request('email');
$password = request('password');

// Validar campos vacíos
if (empty($email) || empty($password)) {
    return back()->withErrors([
        'message' => 'Campos requeridos',
    ]);
}

// Validar campos incorrectos
else if (auth()->attempt(['email' => $email, 'password' => $password]) === false) {
    return back()->withErrors([
        'message' => 'Datos incorrectos',
    ]);

        } else {

            switch (auth()->user()->role) {
                case 'admin':
                    return redirect()->route('admin.index');
                    break;
                case 'coordinator':
                    return redirect()->route('coordinator.index');                    
                    break;
                default:
                    return redirect()->to('/');
                    break;
            }


        }
    }

    public function destroy(){

        auth()->logout();

        return redirect()->to('/');
    }
}
