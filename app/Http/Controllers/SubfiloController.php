<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubFilo;
use App\Models\Filo;
use DB;

class SubfiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subfilos = SubFilo::orderBy('id', 'DESC')->paginate(200000);
          return view('filos.subfilo.index', compact('subfilos'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subfilos=SubFilo::get();
        $filos = Filo::all();
        $grupo =['--','vertebrado', 'Invertebrado'];
        return view('filos.subfilo.create', compact('subfilos', 'grupo','filos'));
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
          ]);

          $input= $request->all();
          $in= $request->filo_id;
         $subfilos= SubFilo::create($input)->id;
         $subfilo = SubFilo::find($subfilos);
        $model = $subfilo->model_has_filos()->create([
            'filo_id' => $in,
        ]);

           return redirect()->route('subfilos.index')
            ->with('success','SubFilo criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subfilos = SubFilo::find($id);
        $filos = Filo::join("model_has_filos","model_has_filos.filo_id","=","filos.id")
        ->where("model_has_filos.model_id",$id)
        ->first(); 
        $reinos = DB::table('reinos')
         ->join('filos', 'reinos.id', '=', 'filos.reino_id')
         ->where("filos.id",$filos->filo_id)
         ->select('reinos.*')
         ->first();
        //  dd($reinos);
        
         return view('filos.subfilo.show', compact('subfilos','filos','reinos'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subfilos=SubFilo::find($id);
        $filos = Filo::all();
        $grupo =['vertebrado', 'Invertebrado'];
        return view('filos.subfilo.edit', compact('subfilos','grupo','filos'));
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
          ]);

          $input= $request->all();
          $in =$request->filo_id;
        //   dd($in);
         $subfilos=SubFilo::find($id);
          $subfilos->update($input);

          $filossub = DB::table("model_has_filos")
           ->where("model_has_filos.model_id",$id)
          ->update([
              'filo_id' => $in,
              'model_id'=> $id,
          ]);
           return redirect()->route('subfilos.index')
            ->with('success','SubFilo actualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table("sub_filos")->where('id',$id)->delete();
        DB::table("model_has_filos")->where('model_id',$id)->delete();
        return redirect()->route('subfilos.index')
                        ->with('success','Subfilo apagada com sucesso');
    }
}
