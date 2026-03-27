@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-xl font-semibold mb-4">Agregar materia</h2>
        <form action="{{ route('save.materia') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm mb-1">Nombre de la materia:</label>
                <input type="text" name="nombre" placeholder="Interactivas" required class="border p-2 rounded w-full">
                <label class="block text-gray-700 text-sm mb-1 mt-2">Código de la materia:</label>
                <input type="text" name="clave" placeholder="Clave" required class="border p-2 rounded w-full">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded w-full"> Agregar Materia</button>
        </form>
    </div>
    <div class="bg-white shadow rounded p-5 overflow-x-auto">
        <h3 class="text-lg font-medium mb-3">Materias</h3>
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Nombre</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Código</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $materia)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm">{{ $materia->nombre }}</td>
                    <td class="px-4 py-2 text-sm">{{ $materia->clave }}</td>
                    <td class="px-4 py-2 text-sm">
                        <form action="{{ route('delete.materia', ['id' => $materia->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('edit.materia', ['id' => $materia->id]) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs ml-2"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach

                @if($materias->isEmpty())
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">No hay materias registradas.</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>
@endsection