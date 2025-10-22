<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // Verifica si se quiere ver todos o solo los recientes
        $modo = $request->query('modo', 'recientes');

        $logins = $modo === 'todos'
            ? Login::all()
            : Login::latest()->take(5)->get();

        return view('logins.index', compact('logins', 'modo'));
    }
}
