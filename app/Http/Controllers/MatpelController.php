<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mapel;

class MatpelController extends Controller
{
	 public function index(Request $request){
        //dd($request->all());
        if($request->has('cari')){
            $data_mapel = \App\mapel:: where('nama','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_mapel = \App\mapel:: all();
        }
        return view ('matpel.index',['data_mapel' => $data_mapel]);
    }

    public function edit(Mapel $mapel)
    {
        return view('matpel.edit', ['mapel'=>$mapel]);
    }

    public function update(Request $request,mapel $mapel)
    {
            $mapel->update($request->all());
            return redirect('/matpel')->with('sukses','Data Berhasil Di Update');
    }
}
