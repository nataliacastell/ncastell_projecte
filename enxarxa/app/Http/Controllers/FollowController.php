<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Http\Controllers\UsuarioController;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;
    private $usuarioController;

    public function __construct()
    {
        // Buscar el follow en la base de datos
        //$follow = Follow::where('publicacion_id', $publicacionId)->first();

        // Guardar los datos del follow en la variable
        //$this->follow = $follow;

        // Crear una instancia del controlador UsuarioController
        //$this->usuarioController = new UsuarioController(Auth::user()->id);
    }

    // Resto de los métodos del controlador Follow...

    private function isOwner()
    {
        // Verificar si el usuario actual es el autor del follow
        $follow = $this->follow;


        //return $follow->usuario_id === $usuarioActual->id;
    }

    private function isAdmin()
    {
        // Verificar si el usuario actual es un usuario admin
        //$usuarioActual = Auth::user();

        return $this->usuarioController->isAdmin();
    }


    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'publicacion_id' => 'required|exists:publicaciones,id',
        ]);

        // Crear un nuevo follow
        $follow = new Follow();
        $follow->publicacion_id = $request->input('publicacion_id');
        $follow->usuario_id = Auth::user()->id;
        $follow->save();

        // Redirigir a la página de la publicación o mostrar un mensaje de éxito
    }

    public function update(Request $request, $id)
    {
        // Comprobar si el usuario actual es el autor del follow o un usuario admin
        if (!$this->isOwner() && !$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
        }

        // Validar los datos de entrada
        $request->validate([
            // Agrega las reglas de validación según tus necesidades
        ]);

        // Actualizar los datos del follow con el ID proporcionado
        $follow = $this->follow;
        $follow->fill($request->all());
        $follow->save();

        // Redirigir a la página del follow actualizado o mostrar un mensaje de éxito
    }

    public function delete($id)
    {
        // Comprobar si el usuario actual es el autor del follow o un usuario admin
        if (!$this->isOwner() && !$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
        }

        // Eliminar el follow con el ID proporcionado
        $follow = $this->follow;
        $follow->delete();

        // Redirigir a la página de la publicación o mostrar un mensaje de éxito
    }

    public function getFollowData()
    {
        // Obtener los datos del follow a través de la variable
        $follow = $this->follow;

        // Retornar los datos del follow o realizar otras acciones con ellos
        return $follow;
    }


}
