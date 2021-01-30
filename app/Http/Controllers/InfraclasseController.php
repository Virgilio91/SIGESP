<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfraClasse;
use App\Models\Classe;
use DB;

class InfraclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $infraclasses = InfraClasse::orderBy('id', 'DESC')->paginate(200000);
        return view('classes.infraclasse.index', compact('infraclasses'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $infraclasses = InfraClasse::get();
      $classes=Classe::all();
      return view('classes.infraclasse.create', compact('infraclasses','classes'));
      dd('infraclasses');
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
          $in = $request->classe_id;
          $infraclasses= InfraClasse::create($input)->id;
          $infraclasse = InfraClasse::find($infraclasses);

          $model = $infraclasse->model_has_classes()->create([
            'classe_id' => $in,
        ]);
           return redirect()->route('infraclasses.index')
            ->with('success','Infraclasse criada com sucesso');
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
        
        $infraclasses=InfraClasse::find($id);
        $classes = Classe::all();
        return view('classes.infraclasse.edit', compact('infraclasses','classes'));
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
          $in = $request->classe_id;
          $infraclasses=InfraClasse::find($id);
          $infraclasses->update($input);
          $classe = DB::table("model_has_classes")
          ->where("model_has_classes.model_id",$id)
         ->update([
             'classe_id' => $in,
              'model_id'=> $id,
         ]);
           return redirect()->route('infraclasses.index')
            ->with('success','Infraclasse actualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("infra_classes")->where('id',$id)->delete();
        DB::table("model_has_classes")->where('model_id',$id)->delete();
        return redirect()->route('infraclasses.index')
                        ->with('success','Infraclasse apagada com sucesso');
     
    }
}
