<template>
    <div>
      <!-- Botón para abrir el modal -->
      <button @click="openModal" aria-haspopup="dialog" aria-expanded="false">Crear Usuario</button>
  
      <!-- Modal -->
      <div v-if="showModal" role="dialog" aria-modal="true" aria-labelledby="modal-title" @keydown.esc="closeModal">
        <div role="document">
          <header>
            <h2 id="modal-title">Crear Usuario</h2>
            <button @click="closeModal" aria-label="Cerrar" autofocus></button>
          </header>
          <form @submit.prevent="submitForm">
            <!-- Campos del formulario -->
            <div>
              <label for="nombre">Nombre:</label>
              <input id="nombre" type="text" v-model="usuario.nombre" required>
            </div>
            <div>
              <label for="correo">Correo Electrónico:</label>
              <input id="correo" type="email" v-model="usuario.correo" required>
            </div>
            <div>
              <label for="contrasena">Contraseña:</label>
              <input id="contrasena" type="password" v-model="usuario.contrasena" required>
            </div>
            <div>
              <label for="tipo">Tipo de Usuario:</label>
              <select id="tipo" v-model="usuario.tipo" required>
                <option value="Admin">Admin</option>
                <option value="Standard">Standard</option>
              </select>
            </div>
            <!-- Botones del formulario -->
            <div>
              <button type="submit">Crear</button>
              <button type="button" @click="closeModal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showModal: false,
        usuario: {
          nombre: '',
          correo: '',
          contrasena: '',
          tipo: 'Standard'
        }
      };
    },
    methods: {
      openModal() {
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
      },
      submitForm() {
        // Validar los datos del formulario
        if (this.validateForm()) {
          // Enviar el formulario por AJAX al servidor
          this.sendFormData();
        } else {
          // Mostrar mensaje de error de validación
          alert('Por favor, complete todos los campos.');
        }
      },
      validateForm() {
        // Validar que todos los campos estén completos
        return (
          this.usuario.nombre.trim() !== '' &&
          this.usuario.correo.trim() !== '' &&
          this.usuario.contrasena.trim() !== ''
        );
      },
      sendFormData() {
        // Enviar el formulario por AJAX al servidor
        // Aquí debes implementar tu lógica para enviar los datos al servidor
        // Puedes utilizar la función fetch() o Axios para realizar la solicitud AJAX
        // Una vez que se haya enviado correctamente, puedes mostrar un mensaje de éxito o realizar otras acciones necesarias
      }
    }
  };
  </script>
  
  <style>
  /* Estilos para el componente */
  </style>
  