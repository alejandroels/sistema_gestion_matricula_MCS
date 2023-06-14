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

        if(auth()->attempt(request(['email','password'])) == false){
            return back()->withErrors([
                'message'=> 'Campos incorrectos o vacios'
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

            // if(auth()->user()->role == 'admin'){
            //     return redirect()->route('admin.index');
            // } else if(auth()->user()->role == 'coordinator'){
            //     return redirect()->route('coordinator.index');
            // } else {
            //     return redirect()->to('/');
            // }

        }
    }

    public function destroy(){

        auth()->logout();

        return redirect()->to('/');
    }
}
