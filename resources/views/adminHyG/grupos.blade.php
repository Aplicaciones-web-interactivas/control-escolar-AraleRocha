@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agregar grupo</h2>
        <form action="{{ route('save.grupo') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Nombre del grupo" required class="border p-2 rounded w-full" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Horario:</label>
                    <select name="horario_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar horario</option>
                        @foreach($horarios as $horario)
                            <option value="{{ $horario->id }}">{{ $horario->id }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</option> 
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm">Agregar Grupo</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Grupos</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Nombre</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Horario</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($grupos as $grupo)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $grupo->nombre }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $grupo->materia_nombre }}: {{ $grupo->hora_inicio }} - {{ $grupo->hora_fin }}</td>
                        <td class="px-4 py-2 text-sm">
                            <form action="{{ route('delete.grupo', ['id' => $grupo->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="{{ route('edit.grupo', ['id' => $grupo->id]) }}" class="inline-block ml-2 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach

                    @if($grupos->isEmpty())
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">No hay grupos registrados.</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection