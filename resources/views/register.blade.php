@extends('layouts.app')

@section('title', 'Register - Control Escolar')

@section('content')
<div class="flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Control Escolar</h1>
                <p class="text-gray-600">Crear una cuenta</p>
            </div>
            @if(session('message'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Nombre
                    </label>
                    <input type="text" name="name" placeholder="Ingresa tu nombre" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    >
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Clave Institucional
                    </label>
                    <input type="text" name="clave_institucional" placeholder="Ej. A12345"required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Contraseña
                    </label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">
                        Confirmar Contraseña
                    </label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                </div>

                <div class="mb-6"> <!--Se anadio esta parte para poder crear usuarios de ambas categorias sin necesidades de hacerlos en el seeder-->
                    <lavel class="block text-gray-700 text-sm font-semibold mb-2">
                        Tipo de usuario
                    </lavel>
                    <select name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                        <option value="">Selecciona un rol</option>
                        <option value="alumno">Alumno</option>
                        <option value="maestro">Maestro</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Registrarme
                </button>
            </form>
            <div class="text-center mt-6 text-sm text-gray-600">
                <p>
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection