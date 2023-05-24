<template>
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="eliminar-usuario-title">
      <div class="modal-content">
        <h2 id="eliminar-usuario-title">Eliminar Usuario</h2>
        <!-- Contenido de la confirmación de eliminación -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      close() {
        // Agregar lógica para cerrar el modal
      },
      confirm() {
        // Agregar lógica para confirmar la eliminación y notificar al usuario
        this.close();
      },
    },
  };
  </script>
  
  <style scoped>
  .modal {
    /* Estilos para el modal */
  }
  
  .modal-content {
    /* Estilos para el contenido del modal */
  }
  </style>
  