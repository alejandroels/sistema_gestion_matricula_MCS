<!DOCTYPE htmli>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title') -Laravel Gestión Cursos CS</title>



<!-- Tailwind CSS Link -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="flex py-5 bg-indigo-500 text-white">
        
        
    
    
    
        <div class="w-1/2 px-12 mr-auto">
            <p class="text-2xl font-bold">Matrícula de la Maestría en la Calidad de Software</p>
        </div>

        <ul class="w-1/2 px-16 ml-auto flex justify-end pt-1">
        @if(auth()->check())    
        
        <li class="mx-6">
        @if(auth()->user()->role == 'admin')
            <p class="text-xl">Bienvenido <b>ADMINASTRADOR</b></p>
        @elseif(auth()->user()->role == 'coordinator')
            <p class="text-xl">Bienvenido <b>COORDINADOR</b></p>
        

        @else 
             <p class="text-xl">Bienvenido <b>{{ auth()->user()->name }}</b></p>

        
        @endif
            </li>
            <li>
                <a href="{{ route('login.destroy')}}" class="font-bold py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:text-indigo-700">Salir</a>

            </li>
            @else
            
            <li class="mx-6">
                <a href="{{ route('login.index')}}" class="font-semibold hover:bg-indigo-700 py-3 px-4 redounded-md">Autenticarse</a>
            </li>
            <!-- <li>
                <a href="{{ route('register.index')}}" class="font-semibold border-2 border-white py-2 px-4 rounded-md hover:bg-white hover:text-indigo-700">Registrar</a>

            </li> -->
            
            @endif

        </ul>

    </nav>

    @yield('content')

</body>
</html>
