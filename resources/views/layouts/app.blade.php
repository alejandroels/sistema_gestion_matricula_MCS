<!DOCTYPE htmli>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<title>@yield('title') -Laravel Gestión Cursos CS</title>

<style>
body {font-family: "Lato", sans-serif;
      background-image: url('{{ asset('images/imagenuci.jpg') }}');
      background-size: cover;
      background-position: center;
    }

 


.navb{
    height: 10%;

}


.sidebar {
  height: 90%;
  width: 160px;
  position: fixed;
  z-index: 0;
  bottom: 0;
  left: 0;
  background-color: #2B2A2A;
  overflow-x: hidden;
  padding-top: 16px;
}

.sidebarback {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: -1;
  bottom: 0;
  left: 0;
  background-color: #2B2A2A;
  overflow-x: hidden;
  padding-top: 16px;
}

.sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  padding: 0px 10px;
  position: relative;
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!-- Tailwind CSS Link -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="navb flex py-3 bg-indigo-500 h-screen/10 text-white">

        <div class="w-1/2 px-12 mr-auto">
            <p class="text-2xl font-bold">Matrícula de la Maestría en la Calidad de Software</p>
        </div>

        <ul class="w-1/2 px-16 ml-auto flex justify-end pt-1">
    @auth    
        
        <li class="mx-6">
        @if(auth()->user()->role == 'admin')
            <p class="text-xl"><b>Secretaria</b></p>
        @elseif(auth()->user()->role == 'coordinator')
            <p class="text-xl"><b>Coordinador</b></p>
        

        @else 
             <p class="text-xl">Bienvenido <b>{{ auth()->user()->name }}</b></p>

        
        @endif
            </li>
            <li>
                <a href="{{ route('login.destroy')}}" class="font-bold py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:text-indigo-700">Salir</a>

            </li>
    @elseguest
            
            <li class="mx-6">
                <a href="{{ route('login.index')}}" class="font-semibold hover:bg-indigo-700 py-3 px-4 redounded-md">Autenticarse</a>
            </li>
            <!-- <li>
                <a href="{{ route('register.index')}}" class="font-semibold border-2 border-white py-2 px-4 rounded-md hover:bg-white hover:text-indigo-700">Registrar</a>

            </li> -->
    @endauth        

        </ul>

    </nav>

    <div class="sidebar">
        @yield('sidebar')
    </div>

    <div class="sidebarback">
    </div>
   
    <div class="main">

   
    @yield('content')
    </div>

    
</body>
</html>
