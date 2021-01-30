<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ac;
use App\Models\Provincia;
use DB;

class AcController extends Controller
{
    function __construct()
    {
    //    $this->middleware('permission:ac-list|ac-create|ac-edit|ac-delete', ['only' => ['index','store']]);
       $this->middleware('permission:ac-create', ['only' => ['create','store']]);
       $this->middleware('permission:ac-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:ac-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acs = Ac::orderBy('id','DESC')->paginate(200000);
        return view('ac.index',compact('acs'))
           ->with('i', ($request->input('page', 1) - 1) * 200000);
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $acs= Ac::get();
        $provincias= Provincia::all();
        $categoria=['Transfronteiriço','Conservação Total','Conservação de Uso Sustentável'];
        $tipo=['Reserva Natural Integral','Parque Nacional ','Monumento Cultural e Natural',
        'Reserva especial','Área de protecção ambiental','Coutada oficial','Área de conservação comunitária',
        'Santuário','Fazenda do bravio'];
      return view('ac.create', compact('acs','categoria','tipo','provincias')); 
      dd($provincias);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $this->validate($request, [
        //      'nome' => 'required|unique:nome',
        //     'Categoria' => 'required',
        //      'provincia_id' => 'required'
        //  ]);
       
       $input=$request->all();
        $acs = Ac::create($input);
       return redirect()->route('acs.index')
      ->with('success','Área de conservação criada com sucesso');
        
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acs = Ac::find($id);  
        $provincia = DB::table('provincias')
        ->join('acs', 'provincias.id', '=', 'acs.provincia_id')
        ->where("acs.id",$id)
        ->select('provincias.*')
        ->first();
        return view('ac.show',compact('acs','provincia'));
        //dd($provincia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acs = Ac::find($id);
        $categoria=['Transfronteiriço','Conservação Total','Conservação de Uso Sustentável'];
        $tipo=['Reserva Natural Integral','Parque Nacional ','Monumento Cultural e Natural',
        'Reserva especial','Área de protecção ambiental','Coutada oficial','Área de conservação comunitária',
        'Santuário','Fazenda do bravio'];
        $provincias = Provincia::all();
         return view('ac.edit', compact('acs','provincias','categoria','tipo'));
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
             'provincia_id' => 'required'
          ]);
        
         $input= $request->all();
         $acs = Ac::find($id);
        $acs->update($input);
        return redirect()->route('acs.index', compact('acs'))
        ->with('success','Área de conservação actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("acs")->where('id',$id)->delete();
        return redirect()->route('acs.index')
                        ->with('success','Área de conservação apagada com sucesso');
    }

 
}
