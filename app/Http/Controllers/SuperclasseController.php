<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperClasse;
use App\Models\Classe;
use DB;

class SuperclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $superclasses = SuperClasse::orderBy('id', 'DESC')->paginate(200000);
        return view('classes.superclasse.index', compact('superclasses'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $superclasses = SuperClasse::get();
        $classes = Classe::all();
        return view('classes.superclasse.create', compact('superclasses','classes'));
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
          $superclasses= SuperClasse::create($input)->id;
          $superclasse= SuperClasse::find($superclasses);
          $model = $superclasse->model_has_classes()->create([
            'classe_id' => $in,
        ]);
           return redirect()->route('superclasses.index')
            ->with('success','Superclasse criada com sucesso');
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
        $superclasses=SuperClasse::find($id);
        $classes = Classe::all();
        return view('classes.superclasse.edit', compact('superclasses','classes'));
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
          $superclasses=SuperClasse::find($id);
          $superclasses->update($input);
          $classe = DB::table("model_has_classes")
          ->where("model_has_classes.model_id",$id)
         ->update([
             'classe_id' => $in,
              'model_id'=> $id,
         ]);
           return redirect()->route('superclasses.index')
            ->with('success','Superclasse actualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("super_classes")->where('id',$id)->delete();
        DB::table("model_has_classes")->where('model_id',$id)->delete();
        return redirect()->route('superclasses.index')
                        ->with('success','Superclasse apagada com sucesso');
    }
}
