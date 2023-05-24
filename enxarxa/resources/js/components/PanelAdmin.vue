<template>
    <div class="panel">
      <h2>Panel de Administración</h2>
      <div class="create-user">
        <button @click="showCreateModal">Crear Usuario</button>
        <modal :show="showCreate" @close="closeModal">
          <crear-usuario @usuario-creado="agregarUsuario"></crear-usuario>
        </modal>
      </div>
      <div class="search">
        <input type="text" v-model="busqueda" @input="buscarUsuarios" placeholder="Buscar usuarios">
      </div>
      <div class="user-list">
        <table>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Correo Electrónico</th>
              <th>Tipo de Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuariosFiltrados" :key="usuario.id">
              <td>{{ usuario.nombre }}</td>
              <td>{{ usuario.correo }}</td>
              <td>{{ usuario.tipo }}</td>
              <td>
                <button @click="showEditModal(usuario)">Editar</button>
                <button @click="showDeleteModal(usuario)">Eliminar</button>
                <button @click="showBanModal(usuario)">Banear</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <modal v-if="showEdit" :show="showEdit" @close="closeModal">
        <editar-usuario :usuario="usuarioSeleccionado" @usuario-editado="actualizarUsuario"></editar-usuario>
      </modal>
      <modal v-if="showDelete" :show="showDelete" @close="closeModal">
        <eliminar-usuario :usuario="usuarioSeleccionado" @usuario-eliminado="eliminarUsuario"></eliminar-usuario>
      </modal>
      <modal v-if="showBan" :show="showBan" @close="closeModal">
        <banear-usuario :usuario="usuarioSeleccionado" @usuario-baneado="banearUsuario"></banear-usuario>
      </modal>
    </div>
  </template>
  
  <script>
  import Modal from './Modal.vue';
  import CrearUsuario from './CrearUsuario.vue';
  import EditarUsuario from './EditarUsuario.vue';
  import EliminarUsuario from './EliminarUsuario.vue';
  import BanearUsuario from './BanearUsuario.vue';
  
  export default {
    components: {
      Modal,
      CrearUsuario,
      EditarUsuario,
      EliminarUsuario,
      BanearUsuario,
    },
    data() {
      return {
        usuarios: [],
        busqueda: '',
        showCreate: false,
        showEdit: false,
        showDelete: false,
        showBan: false,
        usuarioSeleccionado: null,
      };
    },
    mounted() {
      this.obtenerUsuarios();
    },
    methods: {
      obtenerUsuarios() {
        // Lógica para obtener los usuarios desde el servidor
        // ...
      },
      agregarUsuario(usuario) {
        // Lógica para agregar el usuario a la lista
        // ...
      },
      buscarUsuarios() {
        const terminoBusqueda = this.busqueda.toLowerCase().trim();

        if (terminoBusqueda === '') {
            // Si el término de búsqueda está vacío, mostrar todos los usuarios
            this.usuariosFiltrados = this.usuarios;
        } else {
            // Filtrar los usuarios según el término de búsqueda
            this.usuariosFiltrados = this.usuarios.filter(usuario => {
            const nombre = usuario.nombre.toLowerCase();
            const correo = usuario.correo.toLowerCase();

            return nombre.includes(terminoBusqueda) || correo.includes(terminoBusqueda);
            });
        }
        },
      showCreateModal() {
        this.showCreate = true;
      },
      showEditModal(usuario) {
        this.showEdit = true;
        this.usuarioSeleccionado = usuario;
      },
      showDeleteModal(usuario) {
        this.showDelete = true;
        this.usuarioSeleccionado = usuario;
      },
      showBanModal(usuario) {
        this.showBan = true;
        this.usuarioSeleccionado = usuario;
      },
      closeModal() {
        this.showCreate = false;
        this.showEdit = false;
        this.showDelete = false;
        this.showBan = false;
        this.usuarioSeleccionado = null;
      },
      actualizarUsuario(usuarioActualizado) {
        // Lógica para actualizar el usuario en la lista
        // ...
      },
      eliminarUsuario(usuarioEliminado) {
        // Lógica para eliminar el usuario de la lista
        // ...
      },
      banearUsuario(usuarioBaneado) {
        // Lógica para banear al usuario en la lista
        // ...
      },
    },
  };
  </script>
  
  <style>
  /* Estilos para el componente */
  </style>
  