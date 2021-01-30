<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filo;
use App\Models\Reino;
use App\Models\Model_has_filo;
use App\Models\SubFilo;
use DB;

class FiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
      $filos =Filo::orderBy('id', 'DESC')->paginate(200000);
    
          return view('filos.index', compact('filos'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $filos=Filo::get();
        //$subfilos= SubFilo::all();
        $reinos = Reino::all();
     return view('filos.create', compact('filos', 'reinos'));
        
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
             'reino_id' => 'required'
          ]);
       
        
       $input= $request->all();
    //    $in= $request->subfilos;
    
        $filos= Filo::create($input)->id;
        // $subfilos = SubFilo::find($in);
        // $model = $subfilos->model_has_filos()->create([
        //     'filo_id' => $filos,
        // ]);
        //  $model = $subfilos->model_has_filos()->createMany([
        //     'filo_id' => $filos,
        // ]);
        // dd($subfilos);
           return redirect()->route('filos.index')
          ->with('success','Filo criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $filos = Filo::find($id);  
      $reino = DB::table('reinos')
      ->join('filos', 'reinos.id', '=', 'filos.reino_id')
      ->where("filos.id",$id)
      ->select('reinos.*')
      ->first();
    
      return view('filos.show',compact('filos','reino'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filos = Filo::find($id);
        $subfilos= SubFilo::all();
        $reinos = Reino::all();
        $filossub = DB::table("model_has_filos")->where("model_has_filos.filo_id",$id)
            ->pluck('model_has_filos.model_id','model_has_filos.model_id')
            ->all();
            //  dd($filossub);
          return view('filos.edit', compact('filos','reinos','subfilos','filossub'));
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
             'reino_id' => 'required'
          ]);
        
        $input= $request->all();
        $in= $request->sub_filo_id;
         $filos = Filo::find($id); 
         $filos->update($input);

        //  $filossub = DB::table("model_has_filos")
        //  ->where("model_has_filos.filo_id",$id)
        // ->update([
        //     'filo_id' => $id,
        //     'model_id'=> $in,
        // ]);

        return redirect()->route('filos.index')
        ->with('success','Filo actualizado com sucesso');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $teste = SubFilo::join("model_has_filos","model_has_filos.model_id","=","sub_filos.id")
        ->where("model_has_filos.filo_id",$id)
        ->delete(); 
         DB::table("filos")->where('id',$id)->delete();
        DB::table("model_has_filos")->where('filo_id',$id)->delete();
        dd($teste);
        return redirect()->route('filos.index')
                        ->with('success','Filo apagado com sucesso');
    }
}
