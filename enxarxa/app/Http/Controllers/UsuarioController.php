<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\dd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct($id = null)
{
    // Check if an ID is provided
    if ($id !== null) {
        // Find the user in the database
        $this->usuario = Usuario::findOrFail($id);
    }
}


    public function isAdmin()
    {
        return $this->usuario->tipo_usuario === 'Admin';
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        dd('Validating input data'); // Punto de control

        $request->validate([
            'nombre' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios',
            'contrasena' => 'required',
        ]);

        dd('Input data is valid'); // Punto de control

        // Crear un nuevo usuario
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->correo_electronico = $request->input('correo_electronico');
        $usuario->contrasena = Hash::make($request->input('contrasena'));
        $usuario->save();

        dd('User created successfully'); // Punto de control

        // Redirigir a la lista de usuarios con mensaje de éxito
        return back()->with('success', 'Usuario creado exitosamente.');
    }



    public function read($id)
    {
        // Obtener la información del usuario con el ID proporcionado
        $usuario = $this->usuario;

        // Mostrar la información del usuario o redirigir a una página de error si no se encuentra el usuario
    }

    public function update(Request $request, $id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,'.$id,
        ]);

        // Actualizar la información del usuario con el ID proporcionado
        $usuario = $this->usuario;
        $usuario->nombre = $request->input('nombre');
        $usuario->correo_electronico = $request->input('correo_electronico');
        $usuario->save();

        // Redirigir a la página del usuario actualizado o mostrar un mensaje de éxito
    }

    public function delete($id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
        }

        // Eliminar el usuario con el ID proporcionado
        $usuario = $this->usuario;
        $usuario->delete();

        // Redirigir a la lista de usuarios o mostrar un mensaje de éxito
    }

    public function index(Request $request)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
        }

        // Obtener la lista de usuarios con búsqueda y paginación
        $usuarios = Usuario::search($request->input('search'))->paginate(10);

        // Mostrar la lista de usuarios
    }

    public function ban($id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        // Obtener el usuario a banear
        $usuario = $this->usuario;

        // Verificar si el usuario ya está baneado
        if ($usuario->ban) {
            return redirect()->back()->with('error', 'El usuario ya está baneado.');
        }

        // Banea al usuario
        $usuario->ban = true;
        $usuario->save();

        return redirect()->back()->with('success', 'El usuario ha sido baneado correctamente.');
    }

}
