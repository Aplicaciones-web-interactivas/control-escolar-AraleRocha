@extends('layouts.app')
@section('content')
<div>
    <h2>Modificar Grupo</h2>
    <form action="{{ route('update.grupo', ['id' => $grupo->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700">Nombre:</label>
            <input type="text" name="nombre" value="{{ $grupo->nombre }}" placeholder="Nombre del grupo" required class="border p-2 rounded w-full" />
            <label class="block text-gray-700">Horario:</label>
            <select name="horario_id" required class="border p-2 rounded w-full">
                <option value="">Seleccionar horario</option>
                @foreach($horarios as $horario)
                    <option value="{{ $horario->id }}" {{ $grupo->horario_id == $horario->id ? 'selected' : '' }}>{{ $horario->id }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Grupo</button>
    </form>
</div>
@endsection