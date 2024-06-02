<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index(){
        return view('publicaciones.index');
    }

    public function create(){
        return view('publicaciones.create');
    }

    public function show($publicacion){
        return view('publicaciones.show', compact('publicacion'));
    }
}
