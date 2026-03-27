@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar Materia</h2>
        <form action="{{ route('update.materia', ['id' => $materia->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <div>
                <input type="text" name="nombre" value="{{ $materia->nombre }}" placeholder="Nombre de la materia" required class="border p-2 rounded w-full">
                <input type="text" name="clave" value="{{ $materia->clave }}" placeholder="Código de la materia" required class="border p-2 rounded w-full mt-2">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full">Actualizar Materia</button>
        </form>
    </div>
</div>
@endsection