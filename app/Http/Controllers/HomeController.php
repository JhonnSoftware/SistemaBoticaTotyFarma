<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            // Mostrar vista completa o dashboard para admin
            return view('dashboard');
        }
    }
}
