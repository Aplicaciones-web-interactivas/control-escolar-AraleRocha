@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    
    <div class="bg-white shadow-md rounded-lg p-8 border-l-4 border-blue-600">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600 mt-1">Este es tu panel de control para la gestión de calificaciones y grupos.</p>
            </div>
            <div class="hidden md:block">
                <span class="text-sm text-gray-400 font-medium uppercase tracking-wider">Hoy es {{ now()->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-full">
                    <i class="fa-solid fa-graduation-cap text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Estudiantes</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUsuarios ?? '0' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                    <i class="fa-solid fa-star text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Promedio General</p>
                    <p class="text-2xl font-bold text-gray-800">8.5</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center md:text-left">Acciones Rápidas</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('create.calificacion') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-blue-50 group transition-colors border border-dashed border-gray-300">
                <i class="fa-solid fa-plus text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-gray-700">Subir Calificación</span>
            </a>
            
            <a href="#" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-blue-50 group transition-colors border border-dashed border-gray-300">
                <i class="fa-solid fa-list-check text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-gray-700">Ver Grupos</span>
            </a>

            <a href="#" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-blue-50 group transition-colors border border-dashed border-gray-300">
                <i class="fa-solid fa-user-group text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-gray-700">Gestionar Usuarios</span>
            </a>

            <a href="#" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-blue-50 group transition-colors border border-dashed border-gray-300">
                <i class="fa-solid fa-file-pdf text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                <span class="text-sm font-medium text-gray-700">Reportes</span>
            </a>
        </div>
    </div>

</div>
@endsection