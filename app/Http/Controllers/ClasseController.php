<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Filo;
use App\Models\Reino;
use App\Models\Models_has_classe;
use App\Models\SuperClasse;
use App\Models\SubClasse;
use App\Models\InfraClasse;
use App\Models\SubFilo;
use DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $classes =Classe::orderBy('id', 'DESC')->paginate(200000);
    

           return view('classes.index', compact('classes'))
          ->with('i', ($request->input('page', 1) - 1) * 200000); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Classe::get();
        $filos=Filo::all();
        $reinos=Reino::all();
        $subfilos= SubFilo::all();
        // $subclasses = SubClasse::all();
        // $infraclasses = InfraClasse::all();
        // return DB::table('orders')->where('finalized', 1)->exists();
        // $filo = SubFilo::join("model_has_filos","model_has_filos.model_id","=","sub_filos.id")
        // ->where("model_has_filos.filo_id","=",2)->exists();
        // $filo = DB::table('filos')
        // ->join('model_has_filos', 'filos.id', '=', 'model_has_filos.filo_id')
        // ->where("model_has_filos.model_id",4)
        // ->select('filos.*')
        // ->first();
        // dd($filo);
        
         return view('classes.create', compact('classes','filos','reinos','subfilos','subclasses','infraclasses'));
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
             'filo_id' => 'required'
          ]);
        $input= $request->all();
        $in = $request->sub_filo_id;
        $classes = Classe::create($input)->id;
        $subfilos = SubFilo::find($in);
        
        $model = $subfilos->model_has_classes()->create([
            'classe_id' => $classes,
        ]);

        return redirect()->route('classes.index')
       ->with('success','Classe criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classes = Classe::find($id);  
      
        // $subfilos = SubFilo::join("model_has_classes","model_has_classes.model_id","=","sub_filos.id")
        // ->where("model_has_classes.classe_id",$id)
        // ->first(); 

        $filos = DB::table('filos')
            ->join('classes', 'filos.id', '=', 'classes.filo_id')
            ->where("classes.id",$id)
            ->select('filos.*')
            ->first();

        $subfilos = DB::table('sub_filos')
            ->join('model_has_classes', 'model_has_classes.model_id', '=', 'sub_filos.id')
            ->where("model_has_classes.classe_id",$id)
            ->select('sub_filos.*')
            ->first();


         $reinos = DB::table('reinos')
            ->join('filos', 'reinos.id', '=', 'filos.reino_id')
            ->where("filos.id",$filos->id)
            ->select('reinos.*')
            ->first();

            //  dd($subfilos);
        
         return view('classes.show',compact('filos','classes','reinos', 'subfilos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classe::find($id);
        $filos = Filo::all();
        $subfilos= SubFilo::all();
        // $subclasses = SubClasse::all();
        // $infraclasses = InfraClasse::all();
         return view('classes.edit', compact('classes','filos','subfilos'));
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
             'filo_id' => 'required'
          ]);
        
         $input= $request->all();
         $in= $request->sub_filo_id;
        $classes = Classe::find($id);
        $classes->update($input);
        $sub = DB::table("model_has_classes")
        ->where("model_has_classes.classe_id",$id)
       ->update([
           'classe_id' => $id,
            'model_id'=> $in,
       ]);
    //    $infra = DB::table("model_has_classes")
    //    ->where("model_has_classes.classe_id",$id)
    //   ->update([
    //       'classe_id' => $id,
    //       'model_id'=> $in2,
    //   ]);
    //   dd($sub);
        return redirect()->route('classes.index', compact('classes'))
        ->with('success','Classe actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infra = InfraClasse::join("model_has_classes","model_has_classes.model_id","=","infra_classes.id")
        ->where("model_has_classes.classe_id",$id)
        ->delete(); 

        $sub = SubClasse::join("model_has_classes","model_has_classes.model_id","=","sub_classes.id")
        ->where("model_has_classes.classe_id",$id)
        ->delete();

         $super = SuperClasse::join("model_has_classes","model_has_classes.model_id","=","super_classes.id")
        ->where("model_has_classes.classe_id",$id)
        ->delete();

        DB::table("classes")->where('id',$id)->delete();
        DB::table("model_has_classes")->where('classe_id',$id)->delete();
       
      
        return redirect()->route('classes.index')
                        ->with('success','Classe apagada com sucesso');
        // dd($super);
    }

  
}
