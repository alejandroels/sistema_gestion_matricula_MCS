@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200
rounded-lg shadow-lg">

<h1 class="text-3xl text-center font-bold">Registro</h1>

    <form class="mt-4" method="Post">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg p-2 my-2 focus:bg-white" placeholder="Nombre" name="name" id="name">    
    @error('name')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-6 p-2 my-2">*{{$message}}</p>
    @enderror

    <input type="email" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg p-2 my-2 focus:bg-white" placeholder="Correo" name="email" id="email">
    @error('email')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-6 p-2 my-2">*{{$message}}</p>
    @enderror
    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg p-2 my-2 focus:bg-white" placeholder="Contraseña" name="password" id="password">
    @error('password')
    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-6 p-2 my-2">*{{$message}}</p>
    @enderror

    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg p-2 my-2 focus:bg-white" placeholder="Confirmar Contraseña" name="password_confirmation" id="password_confirmation">


    <button type="submit" class="rounded-md bg-indigo-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Enviar</button>
    

</form>

</div>



@endsection