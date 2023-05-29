<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->middleware('web'); // Agregar el middleware web para verificar el token CSRF
        $this->middleware(function ($request, $next) {
            $this->usuario = Auth::user();
            return $next($request);
        });

        $this->middleware('auth'); // Agregar el middleware auth para asegurarse de que el usuario esté autenticado
        $this->middleware('verified'); // Agregar el middleware verified para verificar que el usuario haya verificado su correo electrónico
        $this->middleware('throttle:6,1')->except('login'); // Agregar el middleware throttle para limitar el número de intentos de inicio de sesión
        $this->middleware('guest')->except('logout'); // Agregar el middleware guest para asegurarse de que el usuario no esté autenticado
        $this->middleware('auth')->only(['logout', 'index', 'create', 'read', 'update', 'delete', 'ban', 'isAdmin', 'isVerified', 'isBanned', 'isSuperAdmin', 'isModerator', 'isUser']); // Agregar el middleware auth para asegurarse de que el usuario esté autenticado
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa, redirigir al usuario a una ruta específica
            return redirect()->route('dashboard');
        } else {
            // Autenticación fallida, redirigir al usuario de vuelta al formulario de inicio de sesión con un mensaje de error
            return redirect()->back()->with('error', 'Credenciales inválidas');
        }
    }

    public function isAdmin()
    {
        // Comprobar si el usuario actual es un administrador
        return $this->usuario->tipo_usuario === 'Admin';
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico',
            'contrasena' => 'required',
        ]);

        // Crear un nuevo usuario
        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->correo_electronico = $request->input('correo_electronico');
        $usuario->contrasena = Hash::make($request->input('contrasena'));
        $usuario->save();

        // Redirigir a la lista de usuarios con mensaje de éxito
        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function read($id)
    {
        // Obtener la información del usuario con el ID proporcionado
        $usuario = Usuario::findOrFail($id);

        // Mostrar la información del usuario o redirigir a una página de error si no se encuentra el usuario
        return view('usuario.read', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
            return back()->with('error', 'No tienes permisos para editar usuarios.');
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $id,
        ]);

        // Actualizar la información del usuario con el ID proporcionado
        $usuario = Usuario::findOrFail($id);
        $usuario->nombre = $request->input('nombre');
        $usuario->correo_electronico = $request->input('correo_electronico');
        $usuario->save();

        // Redirigir a la página del usuario actualizado o mostrar un mensaje de éxito
        return back()->with('success', 'Usuario actualizado exitosamente.');
    }

    public function delete($id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
            return back()->with('error', 'No tienes permisos para eliminar usuarios.');
        }

        // Eliminar el usuario con el ID proporcionado
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        // Redirigir a la lista de usuarios o mostrar un mensaje de éxito
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function index(Request $request)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
            return back()->with('error', 'No tienes permisos para ver la lista de usuarios.');
        }

        // Obtener la lista de usuarios con búsqueda y paginación
        $usuarios = Usuario::search($request->input('search'))->paginate(10);

        // Mostrar la lista de usuarios
        return view('usuario.index', compact('usuarios'));
    }

    public function ban($id)
    {
        // Comprobar si el usuario actual es un administrador
        if (!$this->isAdmin()) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        // Obtener el usuario a banear
        $usuario = Usuario::findOrFail($id);

        // Verificar si el usuario ya está baneado
        if ($usuario->ban) {
            // Redirigir a la página de inicio o mostrar un mensaje de error
            return redirect()->back()->with('error', 'El usuario ya está baneado.');
        }

        // Banea al usuario
        $usuario->ban = true;
        $usuario->save();

        // Redirigir a la página de inicio o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'El usuario ha sido baneado correctamente.');
    }
}