<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarea;

use Illuminate\Http\Request;

class TareaMaest_Controller extends Controller
{
    public function indexMaestro() //Pantalla principal para el maestro
    {
        $maestroId = Auth::id();
        
        $grupos = DB::table('grupos') // Grupos del maestro
            ->join('horarios', 'grupos.horario_id', '=', 'horarios.id')
            ->where('horarios.user_id', $maestroId)
            ->select('grupos.id', 'grupos.nombre')
            ->get();
        
        $tareas = DB::table('tareas') // Tareas con nombre de grupo
            ->join('grupos', 'tareas.grupo_id', '=', 'grupos.id')
            ->join('horarios', 'grupos.horario_id', '=', 'horarios.id')
            ->where('horarios.user_id', $maestroId)
            ->select(
                'tareas.id',
                'tareas.titulo',
                'tareas.descripcion',
                'tareas.fecha_entrega',
                'tareas.grupo_id',
                'grupos.nombre as grupo_nombre'
            )
            ->orderByDesc('tareas.created_at')
            ->get();
 
        return view('/Modulo-Examen2/Maestro/tareas', [
            'grupos' => $grupos, // Regresar la lista de grupos y tareas
            'tareas' => $tareas
        ]);
    }
 
    public function saveTarea(Request $request) //Guardar tarea
    {
        $newTarea = new Tarea();
        $newTarea->titulo = $request->titulo;
        $newTarea->descripcion = $request->descripcion;
        $newTarea->fecha_entrega = $request->fecha_entrega;
        $newTarea->grupo_id = $request->grupo_id;
        $newTarea->save();
 
        return redirect()->route('index.maestro');
    }
 
    public function deleteTarea(Request $request) //Borrar tarea
    {
        $tarea = Tarea::find($request->id);
        if ($tarea) {
            $tarea->delete();
        }
 
        return redirect()->route('index.maestro');
    }
 
    public function editTarea($id) //editar tarea
    {
        $maestroId = Auth::id();
        $tarea = DB::table('tareas')
            ->join('grupos', 'tareas.grupo_id', '=', 'grupos.id')
            ->where('tareas.id', $id)
            ->select(
                'tareas.*',
                'grupos.nombre as grupo_nombre'
            )
            ->first();

        $grupos = DB::table('grupos') 
            ->join('horarios', 'grupos.horario_id', '=', 'horarios.id')
            ->where('horarios.user_id', $maestroId)
            ->select('grupos.id', 'grupos.nombre')
            ->get();
 
        if ($tarea){
            return view('/Modulo-Examen2/Maestro/modificaTarea', [
                'tarea'  => $tarea,
                'grupos' => $grupos,
            ]);
        }
 
        return redirect()->route('index.maestro');
    }
 
    public function updateTarea(Request $request)
    {
        $tarea = Tarea::find($request->id);
        if ($tarea) {
            $tarea->grupo_id      = $request->grupo_id;
            $tarea->titulo        = $request->titulo;
            $tarea->descripcion   = $request->descripcion;
            $tarea->fecha_entrega = $request->fecha_entrega;
            $tarea->save();
        }
        return redirect()->route('index.maestro');
    }
 
    // Muestra las entregas
    public function verEntregas($id)
    {
        $tarea = DB::table('tareas')
            ->join('grupos', 'tareas.grupo_id', '=', 'grupos.id')
            ->where('tareas.id', $id)
            ->select('tareas.*', 'grupos.nombre as grupo_nombre')
            ->first();
 
        $entregas = DB::table('entrega_tareas')
            ->join('users', 'entrega_tareas.user_id', '=', 'users.id')
            ->where('entrega_tareas.tarea_id', $id)
            ->select(
                'entrega_tareas.id', 'entrega_tareas.archivo', 'entrega_tareas.created_at',
                'users.name as alumno_nombre'
            )
            ->get();
        if ($tarea){
            return view('/Modulo-Examen2/Maestro/detalletarea', [
                'tarea'    => $tarea,
                'entregas' => $entregas,
            ]);
        }
        return redirect()->route('index.maestro');
    }
 
    // Mostrar el PDF
    public function verEntrega($id)
    {
        $entrega = DB::table('entrega_tareas')
            ->where('id', $id)
            ->first();
        if ($entrega) {
            $ruta = storage_path('app/private/' . $entrega->archivo);
            return response()->file($ruta);
        }
        return redirect()->route('index.maestro');
    }
}
