@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Agregar calificacion</h2>
        <form action="{{ route('save.calificacion') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Grupos:</label>
                    <select id="grupo_id" name="grupo_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Usuario:</label>
                    <select id="usuario_id" name="usuario_id" required class="border p-2 rounded w-full">
                        <option value="">Seleccionar usuario</option>
                        
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Calificacion:</label>
                    <input type="number" name="calificacion" placeholder="10" min='0' max='10' step='0.1' required class="border p-2 rounded w-full" />
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow-sm">Agregar calificacion</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium mb-3">Calificaciones</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Grupo</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Usuario</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Calificacion</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($calificaciones as $calificacion)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $calificacion->grupo_nombre ?? 'Grupo eliminado'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $calificacion->usuario_nombre ?? 'Usuario eliminado'}}</td>
                        <td class="px-4 py-2 text-sm text-gray-800">{{ $calificacion->calificacion }}</td>
                        <td class="px-4 py-2 text-sm">
                            <form action="{{ route('delete.calificacion', ['id' => $calificacion->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="{{ route('edit.calificacion', ['id' => $calificacion->id]) }}" class="inline-block ml-2 bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @if($calificaciones->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No hay calificaciones registrados.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
<script>
// Cargar usuarios por grupo para el select de usuarios
const usuariosPorGrupo = @json($usuariosPorGrupo);
document.getElementById('grupo_id').addEventListener('change', function() {
    const grupoId = this.value;
    const selectUsuarios = document.getElementById('usuario_id');
    selectUsuarios.innerHTML = '<option value="">Selecciona usuario</option>';
    // Cargar usuarios del grupo seleccionado
    if (usuariosPorGrupo[grupoId]) {
        usuariosPorGrupo[grupoId].forEach(usuario => {
            const option = document.createElement('option');
            option.value = usuario.user_id;
            option.textContent = usuario.name;
            selectUsuarios.appendChild(option);
        });
    }
});
</script>
@endsection