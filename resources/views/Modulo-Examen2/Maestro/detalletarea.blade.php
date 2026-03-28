@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="text-star mb-4">
            <a href="{{ route('index.maestro') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded text-sm inline-flex items-center">
                <i class="fa-solid fa-arrow-left"></i>Volver
            </a>
        </div>
        <div>
            <div>
                <h2 class="text-xl font-semibold">Tarea: {{ $tarea->titulo }}</h2>
                <p class="text-sm text-gray-500 mt-1">Grupo: <span class="font-medium text-gray-700">{{ $tarea->grupo_nombre }}</span></p>
                <p class="text-sm text-gray-500">Fecha límite: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}</span></p>
                <p class="text-sm text-gray-500">Descripcion: <span class="font-medium text-gray-700">{{ $tarea->descripcion }}</span></p>
            </div>
            
        </div>
    </div>

    <!--Tabla de las entregas-->
    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Archivos entregados</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Alumno</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Fecha de entrega</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Archivo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($entregas as $entrega)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $entrega->alumno_nombre }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ \Carbon\Carbon::parse($entrega->created_at)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-sm">
                            <a href="{{ route('ver.entrega', ['id' => $entrega->id]) }}"
                                class="inline-flex items-center gap-1 bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-xs">
                                <i class="fa-solid fa-file"></i> Ver entrega
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @if($entregas->isEmpty())
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                            Ningún alumno ha entregado esta tarea.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection