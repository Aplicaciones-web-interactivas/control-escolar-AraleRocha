<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Control Escolar')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen">
    <nav class="bg-white shadow-md py-4 px-6 flex flex-wrap justify-between items-center gap-y-3">
        <ul class="flex flex-wrap items-center gap-x-4 gap-y-2">
            @auth
                <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                    <a href="{{ route('home') }}">Inicio</a>
                </li>
                @if(Auth::user()->role === 'maestro')
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.materias') }}">Materias</a>
                    </li>
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.horarios') }}">Horarios</a>
                    </li>
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.grupos') }}">Grupos</a>
                    </li>
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.inscripciones') }}">Inscripciones</a>
                    </li>
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.calificaciones') }}">Calificaciones</a>
                    </li>
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.maestro') }}">Tareas</a>
                    </li>
                @endif
                @if(Auth::user()->role === 'alumno')
                    <li class="text-gray-700 hover:text-purple-500 font-medium transition">
                        <a href="{{ route('index.alumno') }}">Mis tareas</a>
                    </li>
                @endif
            @endauth
        </ul>

        <div class="flex flex-wrap items-center gap-3">
            @auth
                <span class="text-sm font-semibold text-gray-600 flex items-center">
                    <i class="fa-solid fa-user-circle mr-2 text-lg text-purple-500"></i>
                    {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 shadow-sm transition-all duration-200">
                        Cerrar sesión
                    </button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-purple-600 text-sm font-medium transition">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-purple-700 shadow-sm transition-all duration-200">
                    Registrarse
                </a>
            @endguest
        </div>
    </nav>
    <div class="container mx-auto py-8 px-4">
        @yield('content')
    </div>
</body>
</html>