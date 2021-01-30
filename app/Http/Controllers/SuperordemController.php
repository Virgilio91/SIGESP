<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperOrdem;
use App\Models\Ordem;
use DB;

class SuperordemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $superordem = SuperOrdem::orderBy('id', 'DESC')->paginate(200000);
        return view('ordem.superordem.index', compact('superordem'))
             ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $superordem = SuperOrdem::get();
        $ordens = Ordem::all();
        return view('ordem.superordem.create', compact('superordem','ordens'));
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
          $superordens= SuperOrdem::create($input);
        //   $superordem = SuperOrdem::find($superordens);
        //   $model = $superordem->model_has_ordem()->create([
        //     'ordem_id' => $in,
        // ]);

           return redirect()->route('superordens.index')
            ->with('success','Superordem criada com sucesso');
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
        $superordem=SuperOrdem::find($id);
        return view('ordem.superordem.edit', compact('superordem'));
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
          $superordem=SuperOrdem::find($id);
          $superordem->update($input);
           return redirect()->route('superordens.index')
            ->with('success','Superordem actualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("super_ordems")->where('id',$id)->delete();
        return redirect()->route('superordens.index')
                        ->with('success','Superordem apagada com sucesso');
    }
}
