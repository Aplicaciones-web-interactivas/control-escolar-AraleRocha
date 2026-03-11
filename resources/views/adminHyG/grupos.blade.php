@extends('layouts.app')
@section('content')
<div>
    <div>
        <form action="{{ route('save.grupo') }}" method="POST">
            @csrf
            <div>
                <label class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" placeholder="Nombre del grupo" required class="border p-2 rounded w-full" />
                <label class="block text-gray-700">Horario:</label>
                <select name="horario_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar horario</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id }}">{{ $horario->id }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Grupo</button>
        </form>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->horario_id }}</td>
                    <td>
                        <form action="{{ route('delete.grupo', ['id' => $grupo->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                        </form>
                        <a href="{{ route('edit.grupo', ['id' => $grupo->id]) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modificar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection