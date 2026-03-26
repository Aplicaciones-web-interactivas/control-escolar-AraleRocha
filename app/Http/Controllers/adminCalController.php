<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Calificacion;
use App\Models\Inscripcion;


class adminCalController extends Controller
{
    //metodos para calificaciones
    public function indexCalificaciones()
    { //consulta para obtener las calificaciones con los nombres de los grupos y usuarios
        $calificaciones = DB::table('calificacions')
        ->leftJoin('grupos', 'calificacions.grupo_id', '=', 'grupos.id')
        ->leftJoin('users', 'calificacions.user_id', '=', 'users.id')
        ->select(
            'calificacions.*',
            'grupos.nombre as grupo_nombre',
            'users.name as usuario_nombre'
        )
        ->get();
        //hacer otra consulta con la tabla de inscripcions para saber cuales alumnos pertenecen al grupo selecionado
        $usuariosPorGrupo = DB::table('inscripcions')
            ->join('users', 'inscripcions.user_id', '=', 'users.id')
            ->select(
                'inscripcions.grupo_id',
                'users.id as user_id',
                'users.name'
            )
            ->get()
            ->groupBy('grupo_id');
        $grupos = Grupo::all();
        return view('adminCal.calificaciones', [
            'usuariosPorGrupo' => $usuariosPorGrupo, // Regresar listas completas
            'grupos' => $grupos,
            'calificaciones' => $calificaciones,
        ]);
    }
    public function saveCalificacion(Request $request)
    {
        $calificaciones = new Calificacion();
        $calificaciones->grupo_id = $request->grupo_id;
        $calificaciones->user_id = $request->usuario_id;
        $calificaciones->calificacion = $request->calificacion;
        $calificaciones->save();
        return redirect()->route('index.calificaciones');
    } 
    public function deleteCalificacion(Request $request)
    {
        $calificacion = Calificacion::find($request->id);
        if ($calificacion) {
            $calificacion->delete();
        }
        return redirect()->route('index.calificaciones');
    }
    public function editCalificacion($id)
    {
        $calificacion = DB::table('calificacions') //consulta para obtener la calificacion con los nombres de grupo y usuario, no tendria sentido modificar el grupo para eso mejor crear un nuevo registro
            ->join('grupos', 'calificacions.grupo_id', '=', 'grupos.id')
            ->join('users', 'calificacions.user_id', '=', 'users.id')
            ->select('calificacions.*', 'grupos.nombre as grupo_nombre', 'users.name as usuario_nombre')
            ->where('calificacions.id', $id)
            ->first();
        if ($calificacion) { //modificar solo calificacion
            return view('adminCal.modificaCalificacion', [
                'calificacion' => $calificacion,
            ]);
        }
        return redirect()->route('index.calificaciones');
    }
    public function updateCalificacion(Request $request)
    { // Solo se permite actualizar la calificacion, no el grupo ni el usuario para no desorganizar todo
        $calificacion = Calificacion::find($request->id);
        if ($calificacion) {
            $calificacion->calificacion = $request->calificacion;
            $calificacion->save();
        }
        return redirect()->route('index.calificaciones');
    }

    
    //Metodos para inscripciones
    public function indexInscripciones()
    { //consulta para obtener las inscripciones con los nombres de los grupos y usuarios
        $inscripciones = DB::table('inscripcions')
        ->leftJoin('grupos', 'inscripcions.grupo_id', '=', 'grupos.id')
        ->leftJoin('users', 'inscripcions.user_id', '=', 'users.id')
        ->select(
            'inscripcions.*',
            'grupos.nombre as grupo_nombre',
            'users.name as usuario_nombre'
        )
        ->get();
        //obtener todos los grupos y usuarios para los formularios
        $users = User::all();
        $grupos = Grupo::all();
        return view('adminCal.inscripciones', [
            'users' => $users, // Regresar listas completas
            'grupos' => $grupos,
            'inscripciones' => $inscripciones,
        ]);
    }
    public function saveInscripcion(Request $request)
    {
        $inscripciones = new Inscripcion();
        $inscripciones->grupo_id = $request->grupo_id;
        $inscripciones->user_id = $request->usuario_id;
        $inscripciones->save();
        return redirect()->route('index.inscripciones');
    } 
    public function deleteInscripcion(Request $request)
    {
        $inscripciones = Inscripcion::find($request->id);
        if ($inscripciones) {
            $inscripciones->delete();
        }
        return redirect()->route('index.inscripciones');
    }
    public function editInscripcion($id)
    {
        $calificacion = DB::table('inscripcions') //consulta para obtener los datos anteriores
            ->join('grupos', 'inscripcions.grupo_id', '=', 'grupos.id')
            ->join('users', 'inscripcions.user_id', '=', 'users.id')
            ->select('inscripcions.*', 'grupos.nombre as grupo_nombre', 'users.name as usuario_nombre')
            ->where('inscripcions.id', $id)
            ->first();
        $users = User::all();
        $grupos = Grupo::all();
        if ($calificacion) { //mostrar datos completos para el formulario
            return view('adminCal.modificaInscripcion', [
                'inscripcion' => $calificacion,
                'users' => $users, 
                'grupos' => $grupos,
            ]);
        }
        return redirect()->route('index.inscripciones');
    }
    public function updateInscripcion(Request $request)
    { // Se puede actualizar tanto el grupo como el usuario, se deja la opcion para que se pueda corregir algun error al momento de crear la inscripcion
        $inscripcion = Inscripcion::find($request->id);
        if ($inscripcion) {
            $inscripcion->grupo_id = $request->grupo_id;
            $inscripcion->user_id = $request->usuario_id;
            $inscripcion->save();
        }
        return redirect()->route('index.inscripciones');
    }
}
