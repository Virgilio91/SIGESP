<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reino;
use DB;

class ReinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reinos = Reino::orderBy('id','DESC')->paginate(200000);
       return view('reinos.index',compact('reinos'))
         ->with('i', ($request->input('page', 1) - 1) * 200000);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reinos= Reino::get();
        return view('reinos.create', compact('reinos'));

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
       $reinos= Reino::create($input);
       return redirect()->route('reinos.index')
                        ->with('success','Reino criado do sucesso');
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
         $reinos = Reino::find($id);
         return view('reinos.edit', compact('reinos'));
    //    return view('reinos.edit', compact('reinos'));
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
        $input=$request->all();
        $reinos = Reino::find($id);
        $reinos->update($input);
        
        return redirect()->route('reinos.index')
                        ->with('success','reino updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("reinos")->where('id',$id)->delete();
        return redirect()->route('reinos.index')
                        ->with('success','reino deleted successfully');
    }
}
