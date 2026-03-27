@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agregar horario</h2>

        <form action="{{ route('save.horario') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Materia:</label>
                    <select name="materia_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar materia</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Usuario:</label>
                    <select name="usuario_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar usuario</option>
                        @foreach($users as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Dias:</label>
                    <input type="text" name="dia" placeholder="Ej. L-V" required class="border p-2 rounded w-full" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Hora de inicio:</label>
                    <input type="text" name="hora_inicio" placeholder="Hora de inicio" required class="border p-2 rounded w-full" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Hora de fin:</label>
                    <input type="text" name="hora_fin" placeholder="Hora de fin" required class="border p-2 rounded w-full" />
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow-sm">Agregar Horario</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Horarios</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Materia</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Usuario</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Dias</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Hora inicio</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Hora fin</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($horarios as $horario)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $horario->materia_nombre ?? 'Materia eliminada'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $horario->usuario_nombre ?? 'Usuario eliminado'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $horario->dia }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $horario->hora_inicio }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $horario->hora_fin }}</td>
                        <td class="px-4 py-2 text-sm">
                            <form action="{{ route('delete.horario', ['id' => $horario->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="{{ route('edit.horario', ['id' => $horario->id]) }}" class="inline-block ml-2 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach

                    @if($horarios->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay horarios registrados.</td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection