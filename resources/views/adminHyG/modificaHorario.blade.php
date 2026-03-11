@extends('layouts.app')
@section('content')
<div>
    <h2>Modificar Horario</h2>
    <form action="{{ route('update.horario', ['id' => $horario->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700">Materia:</label>
            <select name="materia_id" required class="border p-2 rounded w-full">
                <option value="">Seleccionar materia</option>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}" {{ $horario->materia_id == $materia->id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                @endforeach
            </select>
            <label class="block text-gray-700">Usuario:</label>
            <select name="usuario_id" required class="border p-2 rounded w-full">
                <option value="">Seleccionar usuario</option>
                @foreach($users as $usuario)
                    <option value="{{ $usuario->id }}" {{ $horario->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                @endforeach
            </select>
            <label class="block text-gray-700">Dia:</label>
            <input type="text" name="dia" value="{{ $horario->dia }}" placeholder="Día de la semana" required class="border p-2 rounded w-full" />
            <label class="block text-gray-700 mt-4">Hora de inicio:</label>
            <input type="text" name="hora_inicio" value="{{ $horario->hora_inicio }}" placeholder="Hora de inicio" required class="border p-2 rounded w-full mt-2" />
            <label class="block text-gray-700 mt-4">Hora de fin:</label>
            <input type="text" name="hora_fin" value="{{ $horario->hora_fin }}" placeholder="Hora de fin" required class="border p-2 rounded w-full mt-2" />
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Horario</button>
    </form>
</div>
@endsection