<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{
    private $usuario;
    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->usuario->id = '';
        $this->usuario->nombre = '';
        $this->usuario->correo_electronico = '';
        $this->usuario->contrasena = '';
        $this->usuario->tipo_usuario = '';
    }

    public function showLoginForm()
    {
        $errors = session('errors') ? session('errors')->getBag('default') : null;
        return view('layout.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasena' => 'required',
        ]);

        $correoElectronico = $request->input('correo_electronico');
        $contrasena = $request->input('contrasena');

        // Verificar las credenciales del usuario manualmente
        $usuario = Usuario::where('correo_electronico', $correoElectronico)->first();

        if ($usuario && Hash::check($contrasena, $usuario->contrasena)) {
            // Credenciales válidas, iniciar sesión manualmente
            session(['usuario_id' => $usuario->id]);

            return redirect()->route('usuarios.lista');
        } else {
            // Redirigir a la página de inicio de sesión con los errores de validación
            return redirect()->route('login')->withErrors(['error' => 'Correo electrónico o contraseña incorrectos.']);
        }
    }




    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


     public function lista(Request $request)
     {
         $usuarioActual = Usuario::find(session('usuario_id'));
         $searchQuery = $request->query('search');
         $sortColumn = $request->query('sort', 'nombre_asc');

         $usuarios = Usuario::query();

         // Aplicar el filtro de búsqueda si se proporciona un término de búsqueda
         if ($searchQuery) {
             $usuarios->where('nombre', 'LIKE', '%' . $searchQuery . '%')
                     ->orWhere('correo_electronico', 'LIKE', '%' . $searchQuery . '%');
         }

         // Aplicar el ordenamiento según la columna seleccionada
         if ($sortColumn === 'nombre_asc') {
             $usuarios->orderBy('nombre', 'asc');
         } elseif ($sortColumn === 'nombre_desc') {
             $usuarios->orderBy('nombre', 'desc');
         } elseif ($sortColumn === 'correo_asc') {
             $usuarios->orderBy('correo_electronico', 'asc');
         } elseif ($sortColumn === 'correo_desc') {
             $usuarios->orderBy('correo_electronico', 'desc');
         }

         $usuarios = $usuarios->get();


         if ($usuarioActual && $usuarioActual->tipo_usuario === 'Admin') {
            // Usuario es un administrador, redirigir a la vista de administrador y enviar los datos en formato json
            return view('layout.usuarios.listaAdmin')->with('usuarios', json_encode($usuarios));
        } else {
            // Usuario es un usuario estándar, redirigir a la vista de usuario estándar
            return view('layout.usuarios.lista')->with('usuarios', json_encode($usuarios));
        }
     }











    ////////////////////////

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
        return redirect()->route('')->with('success', 'Usuario creado exitosamente.');
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








    public function obtenerPublicacionesSeguidos()
    {
        // Obtener los IDs de los usuarios seguidos por el usuario actual
        $usuariosSeguidos = $this->usuario->seguidos->pluck('id');

        try {
            // Obtener las publicaciones de los usuarios seguidos, ordenadas por la más reciente
            $publicaciones = Publicacion::whereIn('usuario_id', $usuariosSeguidos)
                ->orderByDesc('created_at')
                ->get();

            // Verificar si no hay publicaciones encontradas
            if ($publicaciones->isEmpty()) {
                throw new \Exception('No se encontraron publicaciones seguidas');
            }

            // Crear un array con los datos de las publicaciones y los usuarios que las han realizado
            $publicacionesSeguidos = [];

            foreach ($publicaciones as $publicacion) {
                $publicacionSeguida = [
                    'usuario' => [
                        'id' => $publicacion->usuario->id,
                        'nombre' => $publicacion->usuario->nombre,
                    ],
                    'publicacion' => [
                        'id' => $publicacion->id,
                        'texto' => $publicacion->texto,
                        'imagen' => $publicacion->imagen,
                        'altText' => $publicacion->altText,
                        'likes' => $publicacion->likes,
                    ],
                ];

                $publicacionesSeguidos[] = $publicacionSeguida;
            }

            // Devolver el array de publicaciones seguidas como respuesta
            return response()->json($publicacionesSeguidos);
        } catch (\Exception $e) {
            // Ocurrió un error o no se encontraron registros, mostrar los datos del archivo JSON de relleno
            $fakeData = File::get(storage_path('app/json/publicaciones_seguidos_fake.json'));
            return response()->json(json_decode($fakeData));
        }
    }




public function obtenerPublicacionesNoSeguidos()
{
    // Obtener los IDs de los usuarios seguidos por el usuario actual
    $usuariosSeguidos = $this->usuario->seguidos->pluck('id');

    try {
        // Obtener las publicaciones de los usuarios no seguidos, ordenadas por la más reciente
        $publicaciones = Publicacion::whereNotIn('usuario_id', $usuariosSeguidos)
            ->orderByDesc('created_at')
            ->get();

        // Verificar si no hay publicaciones encontradas
        if ($publicaciones->isEmpty()) {
            throw new \Exception('No se encontraron publicaciones de usuarios no seguidos');
        }

        // Crear un array con los datos de las publicaciones y los usuarios que las han realizado
        $publicacionesNoSeguidos = [];

        foreach ($publicaciones as $publicacion) {
            $publicacionNoSeguida = [
                'usuario' => [
                    'id' => $publicacion->usuario->id,
                    'nombre' => $publicacion->usuario->nombre,
                ],
                'publicacion' => [
                    'id' => $publicacion->id,
                    'texto' => $publicacion->texto,
                    'imagen' => $publicacion->imagen,
                    'altText' => $publicacion->altText,
                    'likes' => $publicacion->likes,
                ],
            ];

            $publicacionesNoSeguidos[] = $publicacionNoSeguida;
        }

        // Devolver el array de publicaciones de usuarios no seguidos como respuesta
        return response()->json($publicacionesNoSeguidos);
    } catch (\Exception $e) {
        // Ocurrió un error o no se encontraron registros, mostrar los datos del archivo JSON de relleno
        $fakeData = File::get(storage_path('app/json/publicaciones_no_seguidos_fake.json'));
        return response()->json(json_decode($fakeData));
    }
}
}
