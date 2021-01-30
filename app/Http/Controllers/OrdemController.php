<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordem;
use App\Models\Classe;
use App\Models\Filo;
use App\Models\Reino;
use App\Models\SuperOrdem;
use App\Models\SuperClasse;
use App\Models\SubClasse;
use App\Models\InfraClasse;
use App\Models\Subfilo;
use App\Models\InfraOrdem;
use DB;

class OrdemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ordens =Ordem::orderBy('id', 'DESC')->paginate(200000);
        return view('ordem.index', compact('ordens'))
        ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordens= Ordem::get();
        $classes=Classe::all();
        $superordens = SuperOrdem::all();
        $superclasses = SuperClasse::all();
        $subclasses = SubClasse::all();
        $infraclasses = InfraClasse::all();
        return view('ordem.create', compact('ordens','classes', 'superordens','superclasses','subclasses','infraclasses'));
       // dd($superordens);
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
             'classe_id' => 'required'
          ]);
        $input= $request->all();
        $in = $request->super_classe_id;
        $in2 = $request->sub_classe_id;
        $in3 = $request->infra_classe_id;
        $in4 = $request->super_ordem_id;
        $ordens = Ordem::create($input)->id;
        $superclasses = SuperClasse::find($in);
        $subclasses = SubClasse::find($in2);
        $infraclasses = InfraClasse::find($in3);
        $superordem = SuperOrdem::find($in4);
        $model = $superclasses ->model_has_ordem()->create([
            'ordem_id' => $ordens,
        ]);
        $model = $subclasses->model_has_ordem()->create([
            'ordem_id' => $ordens,
        ]);
        $model = $infraclasses->model_has_ordem()->create([
            'ordem_id' => $ordens,
        ]);
        
        $model = $superordem->model_has_ordem()->create([
          'ordem_id' => $ordens,
      ]);
       
         return redirect()->route('ordem.index')
        ->with('success','Ordem criada com sucesso');
    // dd($superordem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordens = Ordem::find($id);
       
        $superordem = SuperOrdem::join("model_has_ordems","model_has_ordems.model_id","=","super_ordems.id")
        ->where("model_has_ordems.ordem_id",$id)
        ->where("model_has_ordems.model_type","=","App\Models\SuperOrdem")
        ->first(); 

        $classes = DB::table('classes')
        ->join('ordems', 'classes.id', '=', 'ordems.classe_id')
        ->where("ordems.id",$id)
        ->select('classes.*')
        ->first();
    
        $superclasse = SuperClasse::join("model_has_ordems","model_has_ordems.model_id","=","super_classes.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->where("model_has_ordems.model_type","=","App\Models\SuperClasse")
        ->first(); 

        $subclasse = SubClasse::join("model_has_ordems","model_has_ordems.model_id","=","sub_classes.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->where("model_has_ordems.model_type","=","App\Models\SubClasse")
        ->first(); 

        $infraclasse = InfraClasse::join("model_has_ordems","model_has_ordems.model_id","=","infra_classes.id")
        ->where("model_has_ordems.ordem_id",$ordens->id)
        ->where("model_has_ordems.model_type","=","App\Models\InfraClasse")
        ->first(); 

        $filos = DB::table('filos')
        ->join('classes', 'filos.id', '=', 'classes.filo_id')
        ->where("classes.id",$ordens->classe_id)
        ->select('filos.*')
        ->first();

        $subfilos = SubFilo::join("model_has_classes","model_has_classes.model_id","=","sub_filos.id")
         ->where("model_has_classes.classe_id",$ordens->classe_id)
        ->where("model_has_classes.model_type","=","App\Models\SubFilo")
        ->first(); 
       

        $reinos = DB::table('reinos')
        ->join('filos', 'reinos.id', '=', 'filos.reino_id')
        ->where("filos.id",$classes->filo_id)
        ->select('reinos.*')
        ->first();
// dd($subfilos);
        
        return view('ordem.show',compact('ordens','superordem','classes','superclasse','subclasse','infraclasse', 'filos','subfilos', 'reinos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordens = Ordem::find($id);
        $classes = Classe::all();
        $superordens = SuperOrdem::all();
        $superclasses = SuperClasse::all();
        $subclasses = SubClasse::all();
        $infraclasses = InfraClasse::all();
         return view('ordem.edit', compact('classes','ordens','superordens','superclasses','subclasses','infraclasses'));
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
             'classe_id' => 'required'
          ]);
        
         $input= $request->all();
         $in = $request->super_classe_id;
        $in2 = $request->sub_classe_id;
        $in3 = $request->infra_classe_id;
        $in4 = $request->super_ordem_id;
        $ordens = Ordem::find($id);
        $ordens->update($input);
        // $superclasses = SuperClasse::find($in);
        // $subclasses = SubClasse::find($in2);
        // $infraclasses = InfraClasse::find($in3);
  
        $super = DB::table("model_has_ordems")
        ->where("model_has_ordems.ordem_id",$id)
        ->where('model_type', '=','App\Models\SuperClasse')
       ->update([
           'ordem_id' => $id,
           'model_id'=> $in,
       ]);
       $sub = DB::table("model_has_ordems")
       ->where("model_has_ordems.ordem_id",$id)
       ->where('model_type', '=','App\Models\SubClasse')
      ->update([
          'ordem_id' => $id,
          'model_id'=> $in2,
      ]);

      $infra = DB::table("model_has_ordems")
      ->where("model_has_ordems.ordem_id",$id)
      ->where('model_type', '=','App\Models\InfraClasse')
     ->update([
         'ordem_id' => $id,
         'model_id'=> $in3,
     ]);
     $superordem = DB::table("model_has_ordems")
     ->where("model_has_ordems.ordem_id",$id)
     ->where('model_type', '=','App\Models\SuperOrdem')
    ->update([
        'ordem_id' => $id,
        'model_id'=> $in4,
    ]);
    
// dd($input);
        return redirect()->route('ordem.index', compact('classes'))
        ->with('success','Ordem actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infra = InfraOrdem::join("model_has_ordems","model_has_ordems.model_id","=","infra_ordems.id")
        ->where("model_has_ordems.ordem_id",$id)
        ->delete(); 
        
        DB::table("ordems")->where('id',$id)->delete();
        DB::table("model_has_ordems")->where('ordem_id',$id)->delete();
        
        return redirect()->route('ordem.index')
                        ->with('success','Ordem apagada com sucesso');
        // dd($infra);
    }
}
