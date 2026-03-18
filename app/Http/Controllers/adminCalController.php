<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Calificacion;


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
        //obtener todos los grupos y usuarios para los formularios
        $users = User::all();
        $grupos = Grupo::all();
        return view('adminCal.calificaciones', [
            'users' => $users, // Regresar listas completas
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
        $calificacion = DB::table('calificacions') //consulta para obtener la calificacion con los nombres de grupo y usuario, no tendria sentido modificar el grupo o usuario para eso mejor crear un nuevo registro
            ->join('grupos', 'calificacions.grupo_id', '=', 'grupos.id')
            ->join('users', 'calificacions.user_id', '=', 'users.id')
            ->select('calificacions.*', 'grupos.nombre as grupo_nombre', 'users.name as usuario_nombre')
            ->where('calificacions.id', $id)
            ->first();
        if ($calificacion) { //mostrar datos completos para el formulario
            return view('adminCal.modificaCalificacion', [
                'calificacion' => $calificacion,
            ]);
        }
        return redirect()->route('index.calificaciones');
    }
    public function updateCalificacion(Request $request)
    { // Solo se permite actualizar la calificacion, no el grupo ni el usuario
        $calificacion = Calificacion::find($request->id);
        if ($calificacion) {
            $calificacion->calificacion = $request->calificacion;
            $calificacion->save();
        }
        return redirect()->route('index.calificaciones');
    }

}
