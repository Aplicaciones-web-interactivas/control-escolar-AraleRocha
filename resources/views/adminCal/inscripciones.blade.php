@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agregar inscripcion</h2>

        <form action="{{ route('save.inscripcion') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Grupos:</label>
                    <select name="grupo_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
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
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm">Agregar inscripcion</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Inscripciones</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <!--Solo estos dos, por que para obtener mas datos se neceesitan muchas consultas (Grupos - Horarios - Materias) -->
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Grupo</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Usuario</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($inscripciones as $inscripcion)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $inscripcion->grupo_nombre }}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $inscripcion->usuario_nombre }}</td>
                        <td class="px-4 py-2 text-sm">
                            <form action="{{ route('delete.inscripcion', ['id' => $inscripcion->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Eliminar</button>
                            </form>
                            <a href="{{ route('edit.inscripcion', ['id' => $inscripcion->id]) }}" class="inline-block ml-2 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">Modificar</a>
                        </td>
                    </tr>
                    @endforeach

                    @if($inscripciones->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay inscripciones registrados.</td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection