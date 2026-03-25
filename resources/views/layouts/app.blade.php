<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Control Escolar')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <nav class="bg-white shadow-md py-4 px-6">
        <ul class="flex space-x-6">
            <li class="text-gray-700 hover:text-blue-500"><a href="{{ route('index.materias') }}">Materias</a></li>
            <li class="text-gray-700 hover:text-blue-500"><a href="{{ route('index.grupos') }}">Grupos</a></li>
            <li class="text-gray-700 hover:text-blue-500"><a href="{{ route('index.horarios') }}">Horarios</a></li>
            <li class="text-gray-700 hover:text-blue-500"><a href="{{ route('index.inscripciones') }}">Inscripciones</a></li>
            <li class="text-gray-700 hover:text-blue-500"><a href="{{ route('index.calificaciones') }}">Calificaciones</a></li>
                @auth
                <span class="text-sm font-medium text-gray-600">
                    <i class="fa-solid fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                </span>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded hover:bg-red-100 transition">
                        Cerrar sesión
                    </button>
                </form>
                @endauth
             @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 text-sm">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-700">Registrarse</a>
            @endguest
        </ul>
        <div class="flex items-center space-x-4">


           
        </div>
        </nav>
        <div class="container mx-auto py-12">
            @yield('content')
        </div>
</body>
</html>