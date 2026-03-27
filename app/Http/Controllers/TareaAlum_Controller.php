<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Entrega_tarea;
use Illuminate\Http\Request;

class TareaAlum_Controller extends Controller
{
    //Pantalla de inicio del alumno
    public function indexAlumno()
    {
        $alumnoId = Auth::id(); //id del alumno que esta logueado 

        $grupoIds = DB::table('inscripcions') //Grupos en los que está inscrito
            ->where('user_id', $alumnoId)
            ->pluck('grupo_id');

        $tareasEntregadas = DB::table('entrega_tareas') // Tareas ya entregadas
            ->where('user_id', $alumnoId)
            ->pluck('tarea_id');
        
        $tareas = DB::table('tareas') //Tareas de sus grupos con bandera de si ya esta entregada
            ->join('grupos', 'tareas.grupo_id', '=', 'grupos.id')
            ->whereIn('tareas.grupo_id', $grupoIds)
            ->select(
                'tareas.id', 'tareas.titulo', 'tareas.descripcion', 'tareas.fecha_entrega',
                'grupos.nombre as grupo_nombre',
                DB::raw('CASE WHEN tareas.id IN (' . ($tareasEntregadas->isNotEmpty() ? $tareasEntregadas->implode(',') : '0') . ') THEN 1 ELSE 0 END as entregada')
            )
            ->orderBy('tareas.fecha_entrega') 
            ->get();
 
        return view('/Modulo-Examen2/Alumno/tareasAlu', [
            'tareas' => $tareas, // Regresar la lista de tareas
        ]);
    }
 
    //vista para subir el PDF
    public function entregarForm($id)
    {
        $tarea = DB::table('tareas') //obtener la tarea
            ->where('id', $id)
            ->first();
        if ($tarea) { 
            return view('/Modulo-Examen2/Alumno/entregartarea', [
                'tarea' => $tarea
            ]);
        }
        return redirect()->route('index.alumno');
    }
 
    //Guarda la entrega
    public function saveEntrega(Request $request, $id)
    {
        $request->validate([ //Validar que sea pdf
            'archivo' => 'required|file|mimes:pdf',
        ]);
        $alumnoId = Auth::id();
        $tarea = DB::table('tareas')->where('id', $id)->first();  //Obtener el grupo para guardar
        $path = $request->file('archivo')->store('entregas'); // Guardar el archivo en storage/app/private/entregas/
        $entrega = new Entrega_Tarea();
        $entrega->tarea_id = $id;
        $entrega->user_id = $alumnoId;
        $entrega->grupo_id = $tarea->grupo_id;;
        $entrega->archivo = $path;
        $entrega->save();

        return redirect()->route('index.alumno');
    }
}
