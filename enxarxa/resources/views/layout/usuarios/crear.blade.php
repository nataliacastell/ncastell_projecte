<div>
    <!-- Botón para abrir el modal -->
    <button id="crearUsuarioBtn" onclick="openModal()" aria-haspopup="dialog" aria-expanded="false">Crear Usuario</button>

    <!-- Modal -->
    <div id="modal" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="modal-title" onkeydown="handleKeyDown(event)">
      <div role="document">
        <header>
          <h2 id="modal-title">Crear Usuario</h2>
          <button onclick="closeModal()" aria-label="Cerrar" autofocus></button>
        </header>
        <form onsubmit="submitForm(event)" style="margin: 20px;">
          <!-- Agregar el campo CSRF -->
          @csrf

          <!-- Campos del formulario -->
          <div>
            <label for="nombre">Nombre:</label>
            <input id="nombre" type="text" required>
          </div>
          <div>
            <label for="correo">Correo Electrónico:</label>
            <input id="correo" type="email" required>
          </div>
          <div>
            <label for="contrasena">Contraseña:</label>
            <input id="contrasena" type="password" required>
          </div>
          <div>
            <label for="tipo">Tipo de Usuario:</label>
            <select id="tipo" required>
              <option value="Admin">Admin</option>
              <option value="Standard">Standard</option>
            </select>
          </div>
          <!-- Botones del formulario -->
          <div>
            <button type="submit">Crear</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'block';
      document.getElementById('crearUsuarioBtn').style.display = 'none'; // Ocultar el botón al abrir el modal
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
      document.getElementById('crearUsuarioBtn').style.display = 'block'; // Mostrar el botón al cerrar el modal
    }

    function handleKeyDown(event) {
      if (event.keyCode === 27) {
        closeModal();
      }
    }

    function submitForm(event) {
      event.preventDefault();

      // Obtener los valores de los campos del formulario
      const nombre = document.getElementById('nombre').value.trim();
      const correo = document.getElementById('correo').value.trim();
      const contrasena = document.getElementById('contrasena').value.trim();
      const tipo = document.getElementById('tipo').value;

      // Validar los datos del formulario
      if (nombre === '' || correo === '' || contrasena === '') {
        alert('Por favor, complete todos los campos.');
        return;
      }

      // Crear el objeto usuario
      const usuario = {
        nombre,
        correo,
        contrasena,
        tipo
      };

      // Enviar el formulario por AJAX al servidor
      sendFormData(usuario);
    }

    function sendFormData(usuario) {
      fetch('/usuarios', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(usuario),
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Usuario creado exitosamente.');
            closeModal();
          } else {
            alert('Ha ocurrido un error al crear el usuario.');
          }
        })
        .catch(error => {
          alert('Ha ocurrido un error al enviar los datos al servidor.');
        });
    }
  </script>

  <style>
    /* Estilos para el componente */
    #modal {
      /* Estilos del modal */
    }
  </style>
