@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Mis tareas</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Grupo</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Título</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Descripción</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Fecha entrega</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Estado</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Acción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($tareas as $tarea)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $tarea->grupo_nombre }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800 font-medium">{{ $tarea->titulo }}</td>
                        <td class="px-4 py-2 text-sm text-gray-600 max-w-xs truncate">{{ $tarea->descripcion }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-sm">
                            @if($tarea->entregada)
                                <span class="text-green-800 px-2 py-1 rounded text-xs">Entregada</span>
                            @else
                                <span class="text-yellow-800 px-2 py-1 rounded text-xs">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm">
                            @if(!$tarea->entregada)
                                <a href="{{ route('entregar.tarea', ['id' => $tarea->id]) }}"
                                    class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">
                                    Entregar
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">Enviada</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if($tareas->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No tienes tareas asignadas.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection