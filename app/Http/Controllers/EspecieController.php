<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Especie;
use App\Models\Genero;
use App\Models\Reino;
use App\Models\Ac;
use App\Models\Condicoes_localidade;
use App\Models\Valor_ecologico;
use App\Models\SuperOrdem;
use App\Models\SuperClasse;
use App\Models\SubClasse;
use App\Models\InfraClasse;
use App\Models\SubFilo;
use DB;

class EspecieController extends Controller
{
     function __construct()
     {
        // $this->middleware('permission:especies-list|especies-create|especies-edit|especies-delete', ['only' => ['index','store']]);
        $this->middleware('permission:especies-create', ['only' => ['create','store']]);
        $this->middleware('permission:especies-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:especies-delete', ['only' => ['destroy']]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $especies = Especie::orderBy('id','DESC')->paginate(200000);
       return view('especie.index',compact('especies'))
         ->with('i', ($request->input('page', 1) - 1) * 200000);

    // if ($request->ajax()) {
    //     $especies = Especie::latest()->get();
    //     return Datatables::of($especies)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){

    //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
 
    //                     return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    // }
  
    //      return view('especie.index', compact('especies'));
    // }

        
            //dd($reinos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especies=Especie::get();
        $generos =Genero::all();
        $user= auth()->user();
        $nivel__conservacao = ['Extinta', 'Em via de Extinção', 'Em abundância','quase extinta','Estacionária'];
        $categoria_especie= ['Exótica','Endémica'];
        $acs =Ac::all();
        return view('especie.create', compact('generos','especies','user','nivel__conservacao','categoria_especie','acs'));
        //dd($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nome' => 'required',
        //      'familia_id' => 'required'
        //   ]);
    $input= $request->all();
    $input['user_id']= auth()->user()->id;
    
    if($request->hasFile('image') && $request->file('image')->isValid()){
        $filename = $request->image->getClientOriginalName();
        $extension = $request->file('image')->extension();
        $upload = $request->image->storeAs('especies', $filename);
      
    }
    $input['image']= $filename;
    $especies = Especie::create($input)->id;
      
      $especie=Especie::find($especies);
      $especie = Especie::findOrFail($especies);
      $acs= $especie->acs()->attach($request->acs);
      $conds = Condicoes_localidade::create([
        'reproducao' => $request->input('reproducao'),
        'alimentacao' => $request->input('alimentacao'),
        'vegetacao' => $request->input('vegetacao'),
        'abrigo' => $request->input('abrigo'),
        'observacoes' => $request->input('observacoes'),
    ])->id;
    $cond = Condicoes_localidade::findOrFail($conds);
    $c = $cond->id;
    $cond=$especie->condicoes_localidade()->attach($c);
    $valores= Valor_ecologico::create(['valor' => $request->input('valor')])->id;
    $valor = Valor_ecologico::findOrFail($valores);
    $v=$valor->id;
    $valor=$especie->valor_ecologicos()->attach($v);
    
        return redirect()->route('especies.index')
       ->with('success','Espécie criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especies =Especie::find($id);
      //  $e = $especies->genero_id;
        // $conds = $especies->condicoes_localidade();
        // $valor= $especies->valor_ecologicos();
        //  dd($conds);
        $acs = AC::join("especie_acs","especie_acs.ac_id","=","acs.id")
            ->where("especie_acs.especie_id",$id)
            ->get(); 
            
        $conds = Condicoes_localidade::join("condicoes_especies","condicoes_especies.condicoes_localidade_id","=","condicoes_localidades.id")
            ->where("condicoes_especies.especie_id",$id)
            ->get();  
        $valor = Valor_ecologico::join("especie_valor_ecologicos","especie_valor_ecologicos.valor_ecologico_id","=","valor_ecologicos.id")
            ->where("especie_valor_ecologicos.especie_id",$id)
            ->get(); 
            $genero = DB::table('generos')
            ->join('especies', 'generos.id', '=', 'especies.genero_id')
            ->where("especies.id",$id)
            ->select('generos.*')
            ->first();

            $familia = DB::table('familias')
            ->join('generos', 'familias.id', '=', 'generos.familia_id')
            ->where("generos.id",$especies->genero_id)
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

            $superclasse = SuperClasse::join("model_has_classes","model_has_classes.model_id","=","super_classes.id")
            ->where("model_has_classes.classe_id",$classes->id)
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
        
            return view('especie.show',compact('especies','conds','valor','genero','familia','ordens','superordem',
            'classes','superclasse','subclasse','infraclasse','filos','subfilo', 'reinos','acs'));
            //  dd($subclasses);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especies =Especie::find($id);
        // $acs = AC::join("especie_acs","especie_acs.ac_id","=","acs.id")
        // ->where("especie_acs.especie_id",$id)
        // ->get(); 
        $acs = Ac::all();
        $nivel__conservacao = ['Extinta', 'Em via de Extinção', 'Em abundância','quase extinta','Estacionária'];
        $categoria_especie= ['Exótica','Endémica'];
        
    $conds = Condicoes_localidade::join("condicoes_especies","condicoes_especies.condicoes_localidade_id","=","condicoes_localidades.id")
        ->where("condicoes_especies.especie_id",$id)
        ->get();  
    $valor = Valor_ecologico::join("especie_valor_ecologicos","especie_valor_ecologicos.valor_ecologico_id","=","valor_ecologicos.id")
        ->where("especie_valor_ecologicos.especie_id",$id)
        ->get(); 
        $generos = DB::table('generos')
        ->join('especies', 'generos.id', '=', 'especies.genero_id')
        ->where("especies.id",$id)
        ->select('generos.*')
        ->get();

       
        return view('especie.edit',compact('especies','conds','valor','generos','nivel__conservacao','categoria_especie','acs'));
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
        $input=$request->all();
        $input['user_id']= auth()->user()->id;
        $especies =Especie::find($id);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $filename = $request->image->getClientOriginalName();
            $extension = $request->file('image')->extension();
            $upload = $request->image->storeAs('especies', $filename);
          
            $input['image']= $filename;
        }
        
        $especies->update($input);
        $acs= $especies->acs()->sync($request->acs);

        $conds = Condicoes_localidade::join("condicoes_especies","condicoes_especies.condicoes_localidade_id","=","condicoes_localidades.id")
        ->where("condicoes_especies.especie_id",$id)
        // ->get(); 
        ->update([
            'reproducao' => $request->reproducao,
            'alimentacao' => $request->alimentacao,
            'vegetacao' => $request->vegetacao,
            'abrigo' => $request->abrigo,
            'observacoes' => $request->observacoes,
        ]);

        $valor = Valor_ecologico::join("especie_valor_ecologicos","especie_valor_ecologicos.valor_ecologico_id","=","valor_ecologicos.id")
        ->where("especie_valor_ecologicos.especie_id",$id)
        ->update([
            'valor' => $request->valor,
        ]); 
       
        dd($input);
        // return redirect()->route('especies.index', compact('classes'))
        // ->with('success','Especie actualizada com sucesso');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $especies =Especie::find($id);
        $conds = Condicoes_localidade::join("condicoes_especies","condicoes_especies.condicoes_localidade_id","=","condicoes_localidades.id")
        ->where("condicoes_especies.especie_id",$id)
        ->delete();
        $valor = Valor_ecologico::join("especie_valor_ecologicos","especie_valor_ecologicos.valor_ecologico_id","=","valor_ecologicos.id")
        ->where("especie_valor_ecologicos.especie_id",$id)
        ->delete();

        DB::table("especies")->where('id',$id)->delete();
        // $acs= $especies->acs()->detach($id);
        // $cond=$especies->condicoes_localidade()->detach($id);
        // $valor=$especies->valor_ecologicos()->attach($id);
    
        return redirect()->route('especies.index')
                        ->with('success','Especie apagada com sucesso');
    }

    
    public function imageUpload(Request $request)
    {
        $especies = Especie::all();
        $input =$request->all();
        $input['image']= $especies->image;
       if($request->hasFile('image') && $request->file('image')->isValid())
       {
           if($request->image)
                $name= $especies->image;
            else
                $name = $especies->id.kebab_case($especies->nome);

            $extention = $request->image->extension();
            $nameFile ="{$name}.{$extention}";
            $input['image'] = $nameFile;
            $upload = $request->image->storeAs('especies', $nameFile);

            if(!$upload){
                return redirect()
                ->back()
                ->with('error', 'Falha  ao fazer o upload da imagem');
            }
                
       }
       
      // return redirect()->route('profile');
    }

    protected function deleteOldImage()
    {
        if(auth()->user()->avatar)
        {
            Storage::delete('/public/images/'.auth()->user()->avatar);
        } 
    }
   
 
}
