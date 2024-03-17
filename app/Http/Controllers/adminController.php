<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\persona;
use App\Models\libro;
use App\Models\prestamo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class adminController extends Controller
{
    public function home()
    {
        return view('prestamo');
    }

    public function persona()
    {
        $personas = persona::all();
        return view('persona', ['personas' => $personas]);
    }

    public function libro()
    {
        $libros = libro::all();
        return view('libro', ['libros' => $libros]);
    }

    public function prestamo()
    {
        $libros = libro::where('estado', 'Disponible')->get();
        $personas = persona::all();
        $prestamos = prestamo::all();
        return view('prestamo', ['personas' => $personas, 'libros' => $libros, 'prestamos' => $prestamos]);
    }


    //Añadir, editar y borrar persona
    public function nuevaPersona(Request $request)
    {
        $nuevaPersona = new persona(); // Cambio aquí
        
        if($request->file('imPer') != null){
            $nombreArchivo = 'imgPer_'.$request->nombre.'.'.'jpg';

            $file1 = $request->file('imPer');
            Storage::disk('local')->put($nombreArchivo, File::get($file1));
            $nuevaPersona->imagen = $nombreArchivo;
        }


        $nuevaPersona->nombre = $request->nombre;
        $nuevaPersona->direccion = $request->direccion;
        $nuevaPersona->telefono = $request->telefono;
        $nuevaPersona->save();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario

        return redirect()->back();
    }

    public function actualizarPersona(Request $request)
    {
        $idPersona = $request->id;

        $persona = persona::find($idPersona);

        $persona->nombre = $request->nombre;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->save();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario
        return redirect()->back();
    }

    public function eliminarPersona($id)
    {
        $persona = persona::find($id);
        $persona->delete();
        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario
        return redirect()->back();
    }

    //Añadir, editar y borrar libro
    public function nuevoLibro(Request $request)
    {
        $nuevoLibro = new libro();
        $nuevoLibro->titulo = $request->titulo;
        $nuevoLibro->autor = $request->autor;
        $nuevoLibro->editorial = $request->editorial;
        $nuevoLibro->isbn = $request->isbn;
        $nuevoLibro->save();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario

        return redirect()->back();
    }

    public function actualizarLibro(Request $request)
    {
        $idLibro = $request->id; // Obtén el ID del libro del campo oculto 'id'

        $libro = libro::find($idLibro);
        $libro->titulo = $request->titulo;
        $libro->autor = $request->autor;
        $libro->editorial = $request->editorial;
        $libro->isbn = $request->isbn;
        $libro->save();
        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario
        return redirect()->back();
    }


    public function eliminarLibro($id)
    {
        $libro = libro::find($id);
        $libro->delete();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario
        return redirect()->back();
    }

    //Añadir, editar y borrar prestamo
    public function nuevoPrestamo(Request $request)
    {
        // Crea un nuevo préstamo
        $nuevoPrestamo = new Prestamo();
        $nuevoPrestamo->persona = $request->persona;
        $nuevoPrestamo->libro = $request->libro;
        $nuevoPrestamo->estado = $request->estado;
        $nuevoPrestamo->save();

        // Actualiza el estado del libro a "Prestado"
        $libro = libro::where('titulo', $request->libro)->first();
        $libro->estado = 'Prestado';
        $libro->save();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario

        return redirect()->back();
    }

    public function actualizarPrestamo(Request $request)
    {
        $idPrestamo = $request->id; // Obtén el ID del prestamo del campo oculto 'id'

        $prestamo = prestamo::find($idPrestamo);
        $prestamo->persona = $request->persona;
        $prestamo->libro = $request->libro;
        $prestamo->estado = $request->estado;
        $prestamo->save();
        return redirect()->back();
    }

    public function eliminarPrestamo(Request $request, $id)
    {
        $prestamo = Prestamo::find($id);

        // Obtén el libro asociado al préstamo
        $libro = Libro::where('titulo', $prestamo->libro)->first();

        // Elimina el préstamo
        $prestamo->delete();

        // Actualiza el estado del libro a "Disponible"
        $libro->estado = 'Disponible';
        $libro->save();

        return redirect()->back();
    }

    public function devolverPrestamo($id) {
        $prestamo = Prestamo::findOrFail($id);
        $libro = Libro::where('titulo', $prestamo->libro)->first(); // Obtener el libro asociado al préstamo
        $libro->estado = 'Disponible';
        $libro->save();
    
        $prestamo->estado = 'Devuelto';
        $prestamo->save();

        sleep(1); // Espera 1 segundo (opcional, solo para ver el efecto en la interfaz de usuario
    
        return redirect()->back();
    }
    
}
