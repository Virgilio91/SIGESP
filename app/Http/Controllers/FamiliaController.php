<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
use App\Models\Ordem;
use App\Models\Classe;
use App\Models\Filo;
Use App\Models\Reino;
use App\Models\SuperOrdem;
use App\Models\InfraOrdem;
use App\Models\SuperClasse;
use App\Models\SubClasse;
use App\Models\InfraClasse;
use App\Models\Subfilo;
use DB;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $familias =Familia::orderBy('id', 'DESC')->paginate(200000);
    
        return view('familia.index', compact('familias'))
       ->with('i', ($request->input('page', 1) - 1) * 200000); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familias = Familia::get();
        $ordens = Ordem::all();
        $superordens = SuperOrdem::all();
        $infraordens = InfraOrdem::all();
        return view('familia.create', compact('familias','ordens','superordens','infraordens'));
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
             'ordem_id' => 'required'
          ]);
        $input= $request->all();
        // $in = $request->super_ordem_id;
        $in2 = $request->infra_ordem_id;
        $familias = Familia::create($input)->id;
        // $superordens= SuperOrdem::find($in);
        $infraordens =InfraOrdem::find($in2);

        // $model = $superordens ->model_has_familia()->create([
        //     'familia_id' => $familias,
        // ]);
        $model = $infraordens->model_has_familia()->create([
            'familia_id' => $familias,
        ]);
        return redirect()->route('familia.index')
       ->with('success','Familia criada com sucesso');
    // dd($infraordens);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $familia = Familia::find($id);
        $ordens = DB::table('ordems')
        ->join('familias', 'ordems.id', '=', 'familias.ordem_id')
        ->where("familias.id",$id)
        ->select('ordems.*')
        ->first();
        $infraordens = InfraOrdem::join("model_has_familias","model_has_familias.model_id", "=","infra_ordems.id")
        ->where("model_has_familias.familia_id",$id)
        ->first();

        $superordem = SuperOrdem::join("model_has_ordems","model_has_ordems.model_id","=","super_ordems.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->first(); 

        $classes = DB::table('classes')
        ->join('ordems', 'classes.id', '=', 'ordems.classe_id')
        ->where("ordems.id",$familia->ordem_id)
        ->select('classes.*')
        ->first();
        $superclasse = SuperClasse::join("model_has_ordems","model_has_ordems.model_id","=","super_classes.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
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
        // ->first(); 
        $subfilo = SubFilo::join("model_has_classes","model_has_classes.model_id","=","sub_filos.id")
        ->where("model_has_classes.classe_id",$ordens->classe_id)
       ->where("model_has_classes.model_type","=","App\Models\SubFilo")
       ->first(); 

        $reinos = DB::table('reinos')
        ->join('filos', 'reinos.id', '=', 'filos.reino_id')
        ->where("filos.id",$classes->filo_id)
        ->select('reinos.*')
        ->first();
        // dd($superclasse);
        // dd($subfilo);
        return view('familia.show',compact('familia','ordens','superordem','infraordens','classes','subclasse','infraclasse', 'superclasse','filos', 'subfilo','reinos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $familias = Familia::find($id);
        $ordens = Ordem::all();
        $infraordens = InfraOrdem::all();
        return view('familia.edit', compact('familias','ordens','infraordens'));
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
             'ordem_id' => 'required'
          ]);
        
         $input= $request->all();
         $in =$request->infra_ordem_id;
         $familias = Familia::find($id);
        $familias->update($input);
        $infraordem = DB::table("model_has_familias")
        ->where("model_has_familias.familia_id",$id)
       ->update([
           'familia_id' => $id,
            'model_id'=> $in,
       ]);
        return redirect()->route('familia.index', compact('familias'))
        ->with('success','Familia actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("familias")->where('id',$id)->delete();
        DB::table("model_has_familias")->where('familia_id',$id)->delete();
        return redirect()->route('familia.index')
                        ->with('success','Ordem apagada com sucesso');
    }
}
