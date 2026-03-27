@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar Horario</h2>

        <form action="{{ route('update.horario', ['id' => $horario->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 text-sm">Materia:</label>
                <select name="materia_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}" {{ $horario->materia_id == $materia->id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Usuario:</label>
                <select name="usuario_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar usuario</option>
                    @foreach($users as $usuario)
                        <option value="{{ $usuario->id }}" {{ $horario->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Día:</label>
                <input type="text" name="dia" value="{{ $horario->dia }}" required class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Hora inicio:</label>
                <input type="text" name="hora_inicio" value="{{ $horario->hora_inicio }}" required class="border p-2 rounded w-full">
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Hora fin:</label>
                <input type="text" name="hora_fin" value="{{ $horario->hora_fin }}" required class="border p-2 rounded w-full">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full">Actualizar Horario</button>
        </form>
    </div>
</div>
@endsection