@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar Calificacion</h2>

        <form action="{{ route('update.calificacion', ['id' => $calificacion->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 text-sm">Grupo:</label>
                <input type="text" value="{{ $calificacion->grupo_nombre }}" disabled class="border p-2 rounded w-full bg-gray-100">
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Usuario:</label>
                <input type="text" value="{{ $calificacion->usuario_nombre }}" disabled class="border p-2 rounded w-full bg-gray-100">
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Calificación:</label>
                <input type="number" name="calificacion" value="{{ $calificacion->calificacion }}" min="0" max="10" step="0.1" required class="border p-2 rounded w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Actualizar calificacion</button>
        </form>
    </div>
</div>
@endsection