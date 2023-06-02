@extends('layout.master')

@section('content')

<div class="container mx-auto">
    <div class="max-w-lg mx-auto overflow-y-auto" style="max-height: 600px;">
      @foreach ($publicaciones as $publicacion)
        <div class="bg-white rounded shadow p-4 mb-4">
          <div class="mb-4">
            <p class="text-lg font-bold">{{ $publicacion->usuario->nombre }}</p>
            <form action="{{ route('follows.create') }}" method="POST">
              @csrf
              <input type="hidden" name="usuario_id" value="{{ $publicacion->usuario->id }}">
              <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded" id="followButton{{ $publicacion->usuario->id }}">{{ $isFollowing ? 'Dejar de seguir' : 'Seguir' }}</button>
            </form>
          </div>
          <div>
            <p>{{ $publicacion->texto }}</p>
          </div>
          @if ($publicacion->imagen)
            <div>
              <img src="{{ $publicacion->imagen }}" alt="{{ $publicacion->altText }}" class="w-full h-auto rounded">
            </div>
          @endif
          <div class="mt-4">
            <p>Likes: {{ $publicacion->likes }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @push('styles')
    <style>
      .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
      }

      .overflow-y-auto::-webkit-scrollbar-track {
        background-color: #f1f1f1;
      }

      .overflow-y-auto::-webkit-scrollbar-thumb {
        background-color: #888;
      }

      .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background-color: #555;
      }
    </style>
  @endpush

  @push('scripts')
    <script>
      // Función para seguir o dejar de seguir a un usuario
      function toggleFollow(usuarioId) {
        const followButton = document.getElementById(`followButton${usuarioId}`);
        const isFollowing = followButton.innerHTML === 'Dejar de seguir';

        // Enviar la solicitud de seguimiento al servidor
        fetch(`{{ route('follows.create') }}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            usuario_id: usuarioId
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Actualizar el texto del botón
            followButton.innerHTML = isFollowing ? 'Seguir' : 'Dejar de seguir';
          } else {
            // Manejar el error en caso de fallo en la solicitud
            console.error('Error al procesar la solicitud de seguimiento');
          }
        })
        .catch(error => {
          console.error('Error al enviar la solicitud de seguimiento', error);
        });
      }
    </script>
  @endpush
