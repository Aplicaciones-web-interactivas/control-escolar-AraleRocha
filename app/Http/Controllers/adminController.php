<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materia;

class adminController extends Controller
{
    //Controlador para materias
    public function indexMaterias()
    {
        $materias = Materia::all();
        return view('admin.materias', compact('materias'));
    }
    public function indexMaterasAll()
    {
        $materias = Materia::all();
        return view('admin.materias', compact('materias'));
    }
    public function saveMateria(Request $request)
    {
        $newMateria = new Materia();
        $newMateria->nombre = $request->nombre;
        $newMateria->clave = $request->clave;
        $newMateria->save();
        return redirect()->route('index.materias')->with('message', 'Materia guardada correctamente');
    }
    public function deleteMateria(Request $request)
    {
        $materia = Materia::find($request->id);
        if ($materia) {
            $materia->delete();
            return redirect()->route('index.materias')->with('message', 'Materia eliminada correctamente');
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
    public function editMateria($id)
    {
        $materia = Materia::find($id);
        if ($materia) {
            return view('admin.modificamateria')->with('materia', $materia);
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
    
    public function updateMateria(Request $request)
    {
        $materia = Materia::find($request->id);
        if ($materia) {
            $materia->nombre = $request->nombre;
            $materia->clave = $request->clave;
            $materia->save();
            return redirect()->route('index.materias')->with('message', 'Materia actualizada correctamente');
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
}
