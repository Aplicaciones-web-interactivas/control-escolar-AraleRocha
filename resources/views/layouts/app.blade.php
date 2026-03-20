<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Control Escolar')</title>
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
        </ul>
    </nav>
    <div class="container mx-auto py-12">
        @yield('content')
    </div>
    
</body>
</html>