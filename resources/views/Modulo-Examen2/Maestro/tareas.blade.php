@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agregar tarea</h2>
        <form action="{{ route('save.tarea') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Grupo:</label>
                    <select name="grupo_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Título:</label>
                    <input type="text" name="titulo" placeholder="Título de la tarea" required class="border p-2 rounded w-full" />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 mb-1">Descripcion:</label>
                    <textarea name="descripcion" rows="3" placeholder="Descripción de la tarea" required class="border p-2 rounded w-full"></textarea>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Fecha de entrega:</label>
                    <input type="date" name="fecha_entrega" required class="border p-2 rounded w-full" />
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow-sm">
                    Agregar tarea
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Tareas</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Grupo</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Título</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Descripción</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Fecha entrega</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Entregas</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($tareas as $tarea)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $tarea->grupo_nombre ?? 'Grupo eliminado'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $tarea->titulo ?? 'Tarea eliminada'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800 max-w-xs truncate">{{ $tarea->descripcion ?? 'Tarea eliminada' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') ?? 'Tarea eliminada'}}</td>
                        <td class="px-4 py-2 text-sm">
                            <a href="{{ route('ver.entregas', ['id' => $tarea->id]) }}"
                                class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-xs">
                                <i class="fa-solid fa-folder-open"></i> Ver entregas
                            </a>
                        </td>
                        <td class="px-4 py-2 text-sm flex gap-2 items-center">
                            <form action="{{ route('delete.tarea', ['id' => $tarea->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('edit.tarea', ['id' => $tarea->id]) }}"
                                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @if($tareas->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay tareas registradas.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection