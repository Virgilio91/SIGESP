<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubClasse;
use App\Models\Classe;
use DB;

class SubclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subclasses = SubClasse::orderBy('id', 'DESC')->paginate(200000);
        return view('classes.subclasse.index', compact('subclasses'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subclasses = SubClasse::get();
        $classes=Classe::all();
      return view('classes.subclasse.create', compact('infraclasses', 'classes'));
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
          $subclasses= SubClasse::create($input)->id;
         $subclasse= SubClasse::find($subclasses);
        $model = $subclasse->model_has_classes()->create([
            'classe_id' => $in,
        ]);
           return redirect()->route('subclasses.index')
            ->with('success','Subclasse criada com sucesso');
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
        $subclasses=SubClasse::find($id);
        $classes = Classe::all();
        return view('classes.subclasse.edit', compact('subclasses','classes'));
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
          $subclasses=SubClasse::find($id);
          $subclasses->update($input);
          $classe = DB::table("model_has_classes")
          ->where("model_has_classes.model_id",$id)
         ->update([
             'classe_id' => $in,
              'model_id'=> $id,
         ]);
           return redirect()->route('subclasses.index')
            ->with('success','Subclasse actualizada com sucesso');
        // dd($classe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("sub_classes")->where('id',$id)->delete();
        DB::table("model_has_classes")->where('model_id',$id)->delete();
        return redirect()->route('subclasses.index')
                        ->with('success','Subclasse apagada com sucesso');
     
    }
}
