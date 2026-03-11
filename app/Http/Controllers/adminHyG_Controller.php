<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use App\Models\Grupo;

class adminHyG_Controller extends Controller
{
    //metodos para horarios
     public function indexHorarios()
    {
        $users = User::all();
        $materias = Materia::all();
        $horarios = Horario::all();
        return view('adminHyG.horarios', [
            'users' => $users,
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
            return redirect()->route('index.horarios');
        }
        return redirect()->route('index.horarios');
    }
    public function editHorario($id)
    {
        $horario = Horario::find($id);
        if ($horario) {
            $users = User::all();
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
            return redirect()->route('index.horarios');
        }
        return redirect()->route('index.horarios');
    }

    // Metodos para grupos
    public function indexGrupos()
    {
        $horarios = Horario::all();
        $grupos = Grupo::all();
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
            return redirect()->route('index.grupos');
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
            return redirect()->route('index.grupos');
        }
        return redirect()->route('index.grupos');
    }
}
