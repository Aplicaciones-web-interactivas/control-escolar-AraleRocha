@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    
    <div class="bg-white shadow-md rounded-lg p-8">
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

</div>
@endsection