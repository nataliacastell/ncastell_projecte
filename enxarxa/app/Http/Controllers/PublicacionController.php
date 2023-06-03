<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    private $publicacion;

    public function __construct()
    {
        // Buscar la publicación en la base de datos
        //$publicacion = Publicacion::findOrFail($id);

        // Guardar los datos de la publicación en el objeto
        //$this->publicacion = $publicacion;
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'texto' => 'required',
            'imagen' => 'image',
        ]);

        // Crear una nueva publicación
        $publicacion = new Publicacion();
        $publicacion->texto = $request->input('texto');
        $publicacion->imagen = $request->file('imagen')->store('publicaciones');
        $publicacion->likes = 0;
        $publicacion->usuario_id = Auth::user()->id;
        $publicacion->save();

        // Redirigir a la lista de publicaciones del usuario
        return redirect()->route('usuario.publicaciones', ['usuario_id' => Auth::user()->id])->with('success', 'Publicación creada exitosamente.');
    }


    // App\Http\Controllers\PublicacionController.php

    public function update(Request $request, $id)
    {
        // Comprobar si el usuario actual es el autor de la publicación o un usuario admin
        if (!$this->isAuthor() && Auth::user()->tipo !== 'admin') {
            return redirect()->route('inicio')->with('error', 'No tienes permiso para actualizar esta publicación.');
        }

        // Resto del código de la función...
    }

    public function delete($id)
    {
        // Comprobar si el usuario actual es el autor de la publicación o un usuario admin
        if (!$this->isAuthor() && Auth::user()->tipo == 'admin') {
            return redirect()->route('inicio')->with('error', 'No tienes permiso para eliminar esta publicación.');
        }


    }


    public function getUserPublicaciones($usuario_id)
    {
        // Obtener la lista de publicaciones de un usuario específico
        $publicaciones = Publicacion::where('usuario_id', $usuario_id)->get();

        // Mostrar la lista de publicaciones del usuario
        return view('publicacion.list', ['publicaciones' => $publicaciones]);
    }

    public function getFollowedUserPublicaciones($usuario_id)
    {
        $usuariosSeguidos = Usuario::findOrFail($usuario_id)->usuariosSeguidos()->pluck('id');

        $publicaciones = Publicacion::whereIn('usuario_id', $usuariosSeguidos)->get();

        // Mostrar la lista de publicaciones de los usuarios seguidos
        return view('publicacion.list', ['publicaciones' => $publicaciones]);
    }
    public function isAdmin()
    {
        return Auth::user()->tipo === 'admin';
    }


    private function isAuthor()
    {
        // Verificar si el usuario actual es el autor de la publicación
        $publicacion = $this->publicacion;
        $usuarioActual = Auth::user();

        return $publicacion->usuario_id === $usuarioActual->id;
    }
}
