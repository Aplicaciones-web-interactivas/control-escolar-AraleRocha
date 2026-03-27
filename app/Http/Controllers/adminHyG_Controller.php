<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use App\Models\Grupo;

class adminHyG_Controller extends Controller
{
    //metodos para horarios
     public function indexHorarios()
    { //consulta para obtener los horarios con los nombres de las materias y usuarios
        $horarios = DB::table('horarios')
        ->leftJoin('materias', 'horarios.materia_id', '=', 'materias.id')
        ->leftJoin('users', 'horarios.user_id', '=', 'users.id')
        ->select(
            'horarios.*',
            'materias.nombre as materia_nombre',
            'users.name as usuario_nombre'
        )
        ->get();
        //obtener todas las materias y usuarios para los formularios (solo maestros)
        $users = DB::table('users')
        ->where('role', '=', 'maestro')
        ->get();
        $materias = Materia::all();
        return view('adminHyG.horarios', [
            'users' => $users, // Regresar listas completas
            'materias' => $materias,
            'horarios' => $horarios,
        ]);
    }
    public function saveHorario(Request $request)
    {
        $horarios = new Horario();
        $horarios->materia_id = $request->materia_id;
        $horarios->user_id = $request->usuario_id;
        $horarios->dia = $request->dia;
        $horarios->hora_inicio = $request->hora_inicio;
        $horarios->hora_fin = $request->hora_fin;
        $horarios->save();
        return redirect()->route('index.horarios');
    } 
    public function deleteHorario(Request $request)
    {
        $horario = Horario::find($request->id);
        if ($horario) {
            $horario->delete();
        }
        return redirect()->route('index.horarios');
    }
    public function editHorario($id)
    {
        $horario = Horario::find($id);
        if ($horario) { //mostrar datos completos para el formulario
            $users = DB::table('users')
                ->where('role', '=', 'maestro')
                ->get();
            $materias = Materia::all();
            return view('adminHyG.modificaHorario', [
                'users' => $users,
                'materias' => $materias,
                'horario' => $horario,
            ]);
        }
        return redirect()->route('index.horarios');
    }
    public function updateHorario(Request $request)
    {
        $horario = Horario::find($request->id);
        if ($horario) {
            $horario->materia_id = $request->materia_id;
            $horario->user_id = $request->usuario_id;
            $horario->dia = $request->dia;
            $horario->hora_inicio = $request->hora_inicio;
            $horario->hora_fin = $request->hora_fin;
            $horario->save();
        }
        return redirect()->route('index.horarios');
    }

    // Metodos para grupos
    public function indexGrupos()
    { // consulta para obtener los grupos con los nombres de las materias y horarios
        $grupos = DB::table('grupos')
        ->leftJoin('horarios', 'grupos.horario_id', '=', 'horarios.id')
        ->leftJoin('materias', 'horarios.materia_id', '=', 'materias.id')
        ->select(
            'grupos.*',
            'materias.nombre as materia_nombre',
            'horarios.hora_inicio',
            'horarios.hora_fin'
        )
        ->get();
        // Obtener todos los horarios para el formulario de creación
        $horarios = Horario::all();
        return view('adminHyG.grupos', [
            'horarios' => $horarios,
            'grupos' => $grupos,
        ]);
    }
    public function saveGrupo(Request $request)
    {
        $grupo = new Grupo();
        $grupo->nombre = $request->nombre;
        $grupo->horario_id = $request->horario_id;
        $grupo->save();
        return redirect()->route('index.grupos');
    }
    public function deleteGrupo(Request $request)
    {
        $grupo = Grupo::find($request->id);
        if ($grupo) {
            $grupo->delete();
        }
        return redirect()->route('index.grupos');
    }
    public function editGrupo($id)
    {
        $grupo = Grupo::find($id);
        if ($grupo) {
            $horario = Horario::all();
            return view('adminHyG.modificaGrupo', [
                'horarios' => $horario,
                'grupo' => $grupo
            ]);
        }
        return redirect()->route('index.grupos');
    }
    public function updateGrupo(Request $request)
    {
        $grupo = Grupo::find($request->id);
        if ($grupo) {
            $grupo->nombre = $request->nombre;
            $grupo->horario_id = $request->horario_id;
            $grupo->save();
        }
        return redirect()->route('index.grupos');
    }
}
