@extends('layouts.app')
@section('content')
<div>
    <div>
        <form action="{{ route('save.horario') }}" method="POST">
            @csrf
            <div>
                <label class="block text-gray-700">Materia:</label>
                <select name="materia_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                <label class="block text-gray-700">Usuario:</label>
                <select name="usuario_id" required class="border p-2 rounded w-full">
                    <option value="">Seleccionar usuario</option>
                    @foreach($users as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                <label class="block text-gray-700">Dia:</label>
                <input type="text" name="dia" placeholder="Día de la semana" required class="border p-2 rounded w-full" />
                <label class="block text-gray-700 mt-4">Hora de inicio:</label>
                <input type="text" name="hora_inicio" placeholder="Hora de inicio" required class="border p-2 rounded w-full" />
                <label class="block text-gray-700 mt-4">Hora de fin:</label>
                <input type="text" name="hora_fin" placeholder="Hora de fin" required class="border p-2 rounded w-full mt-2" />
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Horario</button>
        </form>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Usuario</th>
                    <th>Dia</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->materia_id }}</td>
                    <td>{{ $horario->user_id }}</td>
                    <td>{{ $horario->dia }}</td>
                    <td>{{ $horario->hora_inicio }}</td>
                    <td>{{ $horario->hora_fin }}</td>
                    <td>
                        <form action="{{ route('delete.horario', ['id' => $horario->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                        </form>
                        <a href="{{ route('edit.horario', ['id' => $horario->id]) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modificar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection