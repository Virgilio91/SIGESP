<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Familia;
use App\Models\Ordem;
use App\Models\Classe;
use App\Models\Filo;
use App\Models\Reino;
use App\Models\SuperOrdem;
use App\Models\SuperClasse;
use App\Models\SubClasse;
use App\Models\InfraClasse;
use App\Models\Subfilo;
use DB;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $generos =Genero::orderBy('id', 'DESC')->paginate(200000);
    
        return view('genero.index', compact('generos'))
       ->with('i', ($request->input('page', 1) - 1) * 200000); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::get();
        $familias = Familia::all();
        return view('genero.create', compact('generos','familias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
             'familia_id' => 'required'
          ]);
        $input= $request->all();
        $generos = Genero::create($input);
        return redirect()->route('genero.index')
       ->with('success','Género criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genero= Genero::find($id);
        $familia = DB::table('familias')
        ->join('generos', 'familias.id', '=', 'generos.familia_id')
        ->where("generos.id",$id)
        ->select('familias.*')
        ->first();
        
        $ordens = DB::table('ordems')
        ->join('familias', 'ordems.id', '=', 'familias.ordem_id')
        ->where("familias.id",$genero->familia_id)
        ->select('ordems.*')
        ->first();

        $superordem = SuperOrdem::join("model_has_ordems","model_has_ordems.model_id","=","super_ordems.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->first(); 

        $classes = DB::table('classes')
        ->join('ordems', 'classes.id', '=', 'ordems.classe_id')
        ->where("ordems.id",$familia->ordem_id)
        ->select('classes.*')
        ->first();
        // $superclasse = SuperClasse::join("model_has_classes","model_has_classes.model_id","=","super_classes.id")
        // ->where("model_has_classes.classe_id",$classes->id)
        // ->first(); 
        $superclasse = SuperClasse::join("model_has_ordems","model_has_ordems.model_id","=","super_classes.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->where("model_has_ordems.model_type","=","App\Models\SuperClasse")
        ->first(); 
        $subclasse = SubClasse::join("model_has_classes","model_has_classes.model_id","=","sub_classes.id")
        ->where("model_has_classes.classe_id",$classes->id)
        ->first(); 
        $infraclasse = InfraClasse::join("model_has_classes","model_has_classes.model_id","=","infra_classes.id")
        ->where("model_has_classes.classe_id",$classes->id)
        ->first(); 

        $filos = DB::table('filos')
        ->join('classes', 'filos.id', '=', 'classes.filo_id')
        ->where("classes.id",$ordens->classe_id)
        ->select('filos.*')
        ->first();

        // $subfilo = SubFilo::join("model_has_filos","model_has_filos.model_id","=","sub_filos.id")
        // ->where("model_has_filos.filo_id",$filos->id)
        // ->get(); 
        $subfilos = SubFilo::join("model_has_classes","model_has_classes.model_id","=","sub_filos.id")
        ->where("model_has_classes.classe_id",$ordens->classe_id)
       ->where("model_has_classes.model_type","=","App\Models\SubFilo")
       ->first(); 

        $reinos = DB::table('reinos')
        ->join('filos', 'reinos.id', '=', 'filos.reino_id')
        ->where("filos.id",$classes->filo_id)
        ->select('reinos.*')
        ->first();
        // dd($superclasse);

        return view('genero.show',compact('genero','familia','ordens','superordem','classes','superclasse','subclasse','infraclasse', 'filos', 'subfilos','reinos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generos = Genero::find($id);
        $familias = Familia::all();
        return view('genero.edit', compact('familias','generos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
             'familia_id' => 'required'
          ]);
        
         $input= $request->all();
         $generos = Genero::find($id);
        $generos->update($input);
        return redirect()->route('genero.index', compact('generos'))
        ->with('success','Género actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("generos")->where('id',$id)->delete();
        return redirect()->route('genero.index')
                        ->with('success','Género apagado com sucesso');
    }
}
