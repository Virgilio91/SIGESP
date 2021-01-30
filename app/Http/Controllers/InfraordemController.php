<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfraOrdem;
use App\models\Ordem;
use DB;

class InfraordemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $infraordem = InfraOrdem::orderBy('id', 'DESC')->paginate(200000);
        return view('ordem.infraordem.index', compact('infraordem'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $infraordem = infraOrdem::get();
        $ordens = Ordem::all();
        return view('ordem.infraordem.create', compact('infraordem','ordens'));
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
          $in =$request->ordem_id;
          $infraordens= InfraOrdem::create($input)->id;
          $infraordem = InfraOrdem::find($infraordens);
          $model = $infraordem->model_has_ordem()->create([
            'ordem_id' => $in,
        ]);

           return redirect()->route('infraordens.index')
            ->with('success','Infraordem criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infraordem=InfraOrdem::find($id);
        $ordens = Ordem::all();
        return view('ordem.infraordem.edit', compact('infraordem', 'ordens'));
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
          $in = $request->ordem_id;
          $infraordens=InfraOrdem::find($id);
          $infraordens->update($input);
          $classe = DB::table("model_has_ordems")
          ->where("model_has_ordems.model_id",$id)
         ->update([
             'ordem_id' => $in,
              'model_id'=> $id,
         ]);
         return redirect()->route('infraordens.index')
         ->with('success','Infraordem actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("infra_ordems")->where('id',$id)->delete();
        DB::table("model_has_ordems")->where('model_id',$id)->delete(); 
        return redirect()->route('infraordens.index')
        ->with('success','InfraOrdem apagada com sucesso');
    }
}
