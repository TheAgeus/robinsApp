<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class HomeController extends Controller
{
    public function login()
    {
        if (auth()->check()) 
        {
            $empresas = Empresa::all();
            return redirect()->route('dashboard')->with('empresas', $empresas);
        }

        return view('welcome');
    }

    public function index()
    {
        if (auth()->check()) 
        {
            $empresas = Empresa::all();
            return view('dashboard')->with('empresas', $empresas);
        } 

        return view('welcome');

    }
}
