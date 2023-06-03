@extends('layout.master')

@section('content')
<link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

<div class="container mx-auto py-4 invisible" id="contentContainer">
    <h1 class="text-2xl font-bold mb-4">Listado de Usuarios</h1>
    <div class="flex items-center mb-4">
        <label for="search" class="mr-2">Buscar:</label>
        <input type="text" id="search" class="border border-gray-300 px-2 py-1 rounded" placeholder="Buscar usuarios">
    </div>
    <div class="flex items-center">
        <label for="sort" class="mr-2">Ordenar por:</label>
        <select id="sort" class="border border-gray-300 px-2 py-1 rounded">
            <option value="nombre_asc">Nombre Ascendente</option>
            <option value="nombre_desc">Nombre Descendente</option>
            <option value="correo_asc">Correo Electrónico Ascendente</option>
            <option value="correo_desc">Correo Electrónico Descendente</option>
        </select>
    </div>
    <div class="table-responsive">
        <table id="userTable" class="table w-full mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Iterar sobre los usuarios y mostrar los datos --}}
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->correo_electronico }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p id="noDataMessage" class="text-center mt-4 text-gray-500 hidden">No hay datos</p>
</div>
@endsection

@push('scripts')
<script>
     window.addEventListener('load', function () {
        document.getElementById('contentContainer').classList.remove('invisible');
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Variables para almacenar el estado actual de búsqueda y ordenamiento
        let searchQuery = '';
        let sortColumn = 'nombre_asc';

        // Función para cargar los datos de los usuarios
        function loadUsers() {
            fetch("{{ route('usuarios.lista') }}?search=" + searchQuery + "&sort=" + sortColumn)
                .then(response => response.json())
                .then(data => {
                    let usuarios = data.usuarios;
                    let tbody = '';

                    // Generar filas de la tabla con los datos de los usuarios
                    usuarios.forEach(function (usuario) {
                        tbody += `
                            <tr>
                                <td>${usuario.nombre}</td>
                                <td>${usuario.correo_electronico}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Editar</a>
                                    <a href="#" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        `;
                    });

                    // Actualizar el contenido de la tabla
                    document.getElementById('userTable').getElementsByTagName('tbody')[0].innerHTML = tbody;

                    // Mostrar mensaje de "No hay datos" si la tabla está vacía
                    if (usuarios.length === 0) {
                        document.getElementById('noDataMessage').classList.remove('hidden');
                    } else {
                        document.getElementById('noDataMessage').classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Cargar los usuarios al cargar la página
        loadUsers();

        // Actualizar los usuarios al cambiar el término de búsqueda
        document.getElementById('search').addEventListener('input', function () {
            searchQuery = this.value.trim();
            loadUsers();
        });

        // Actualizar los usuarios al cambiar la columna de ordenamiento
        document.getElementById('sort').addEventListener('change', function () {
            sortColumn = this.value;
            loadUsers();
        });
    });
</script>
@endpush
