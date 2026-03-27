@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="bg-white shadow rounded p-5">
        <h2 class="text-lg font-semibold mb-1">Entregar tarea</h2>
        <p class="text-sm text-gray-500 mb-4">{{ $tarea->titulo }}</p>
        <form action="{{ route('save.entrega', ['id' => $tarea->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm mb-1">Archivo PDF:</label>
                <label for="archivo" class="block border border-gray-300 rounded p-2 cursor-pointer text-sm text-gray-500">
                    <i class="fa-solid fa-paperclip mr-1"></i>
                    <span id="nombre-archivo">Seleccionar archivo</span>
                </label>
                <input type="file" id="archivo" name="archivo" accept=".pdf" required class="hidden" />
                <p class="text-xs text-gray-400 mt-1">Solo se aceptan archivos en formato PDF.</p>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded w-full">
                    Subir entrega
                </button>
                <a href="{{ route('index.alumno') }}" class="block text-center bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded w-full">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script> 
    //Script basico solo para poner el nombre y que se vea con diseno
    document.getElementById('archivo').addEventListener('change', function () {
        const nombre = this.files[0] ? this.files[0].name : 'Seleccionar archivo';
        document.getElementById('nombre-archivo').textContent = nombre;
    });
</script>
@endsection