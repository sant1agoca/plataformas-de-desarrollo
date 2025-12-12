<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración principal.
     * Esta ruta está protegida por el middleware 'role:admin'.
     */
    public function index()
    {
        // NOTA: Aquí podrías pasar estadísticas, listados de usuarios, etc.
        
        // El método simplemente devuelve la vista 'admin.index'.
        return view('admin.index');
    }
}