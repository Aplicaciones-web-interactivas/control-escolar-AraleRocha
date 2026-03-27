@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar inscripciones</h2>

        <form action="{{ route('update.inscripcion', ['id' => $inscripcion->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <div> <!--Formulario para editar datos sin permitir cambios en grupo y usuario -->
                <label class="block text-gray-700 text-sm">Grupo:</label>
                <select name="grupo_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar grupo</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}" {{ $inscripcion->grupo_id == $grupo->id ? 'selected' : '' }}>{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Usuario:</label>
                <select name="usuario_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar usuario</option>
                    @foreach($users as $usuario)
                        <option value="{{ $usuario->id }}" {{ $inscripcion->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full">Actualizar inscripcion</button>
        </form>
    </div>
</div>
@endsection