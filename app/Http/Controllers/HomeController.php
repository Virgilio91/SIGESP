<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->count();
        $acs = DB::table('acs')->count();
        $especies = DB::table('especies')->count();
        $especies_extinta = DB::table('especies')
        ->where('nivel__conservacao', "Extinta")
        ->count();
        $especies_quase = DB::table('especies')
        ->where('nivel__conservacao', "quase extinta")
        ->count();
        $especies_via = DB::table('especies')
        ->where('nivel__conservacao', "Em via de Extinção")
        ->count();
        $especies_es = DB::table('especies')
        ->where('nivel__conservacao', "Estacionárias")
        ->count();
        $especies_ab = DB::table('especies')
        ->where('nivel__conservacao', "Em abundancia")
        ->count();

        //vertebrados 
        $mamiferos = DB::table('classes')
        ->where('nome', "mammalia")
        ->count();
        $aves = DB::table('classes')
        ->where('nome', "Aves")
        ->count();
        $repteis = DB::table('classes')
        ->where('nome', "Repteis")
        ->count();

        
         return view('home', compact('users','acs','especies','especies_extinta','especies_quase','especies_via',
         'especies_es','especies_ab','mamiferos','aves','repteis'));
    }
}
