@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar Grupo</h2>

        <form action="{{ route('update.grupo', ['id' => $grupo->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 text-sm">Nombre:</label>
                <input type="text" name="nombre" value="{{ $grupo->nombre }}" required class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Horario:</label>
                <select name="horario_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar horario</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id }}" {{ $grupo->horario_id == $horario->id ? 'selected' : '' }}>{{ $horario->id }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full">Actualizar Grupo</button>
        </form>
    </div>
</div>
@endsection