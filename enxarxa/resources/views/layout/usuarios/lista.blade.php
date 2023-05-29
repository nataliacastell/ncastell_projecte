@extends('layout.master')

@section('content')
    <div class="container">
        <h1>Listado de Usuarios</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="search">Buscar:</label>
                    <input type="text" id="search" class="form-control" placeholder="Buscar usuarios">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sort">Ordenar por:</label>
                    <select id="sort" class="form-control">
                        <option value="nombre_asc">Nombre Ascendente</option>
                        <option value="nombre_desc">Nombre Descendente</option>
                        <option value="correo_asc">Correo Electrónico Ascendente</option>
                        <option value="correo_desc">Correo Electrónico Descendente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="userTable" class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Aquí se cargarán los datos de los usuarios --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Variables para almacenar el estado actual de búsqueda y ordenamiento
            let searchQuery = '';
            let sortColumn = 'nombre_asc';

            // Función para cargar los datos de los usuarios
            function loadUsers() {
                $.ajax({
                    url: "{{ route('usuarios.lista') }}",
                    type: "GET",
                    data: {
                        search: searchQuery,
                        sort: sortColumn
                    },
                    success: function(response) {
                        let users = response.users;
                        let tbody = '';

                        // Generar filas de la tabla con los datos de los usuarios
                        users.forEach(function(user) {
                            tbody += `
                                <tr>
                                    <td>${user.nombre}</td>
                                    <td>${user.correo_electronico}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Editar</a>
                                        <a href="#" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            `;
                        });

                        // Actualizar el contenido de la tabla
                        $('#userTable tbody').html(tbody);
                    }
                });
            }

            // Cargar los usuarios al cargar la página
            loadUsers();

            // Actualizar los usuarios al cambiar el término de búsqueda
            $('#search').on('input', function() {
                searchQuery = $(this).val().trim();
                loadUsers();
            });

            // Actualizar los usuarios al cambiar la columna de ordenamiento
            $('#sort').on('change', function() {
                sortColumn = $(this).val();
                loadUsers();
            });
        });
    </script>
@endpush
