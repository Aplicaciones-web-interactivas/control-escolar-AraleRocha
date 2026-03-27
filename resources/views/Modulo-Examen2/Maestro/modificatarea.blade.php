@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-4">Modificar tarea</h2>
        <form action="{{ route('update.tarea', ['id' => $tarea->id]) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $tarea->id }}">
            <div>
                <label class="block text-gray-700 text-sm">Grupo:</label>
                <select name="grupo_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar grupo</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}" {{ $tarea->grupo_id == $grupo->id ? 'selected' : '' }}>{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Título:</label>
                <input type="text" name="titulo" value="{{ $tarea->titulo }}" required class="border p-2 rounded w-full" />
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Descripción:</label>
                <textarea name="descripcion" rows="3" required class="border p-2 rounded w-full">{{ $tarea->descripcion }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 text-sm">Fecha de entrega:</label>
                <input type="date" name="fecha_entrega" value="{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('Y-m-d') }}" required class="border p-2 rounded w-full" />
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full">Actualizar tarea</button>
        </form>
    </div>
</div>
@endsection