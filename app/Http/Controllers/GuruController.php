<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Exports\guruExport;
use App\Http\Requests\ChangePasswordRequest;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
Use Hash;
use App\User;
use Illuminate\Http\Request;
use App\guru;

class GuruController extends Controller
{   
    public function profile_ku(Guru $guru){
        return view('guru.profile',compact(['guru']));
    }

    public function profile(Guru $guru){
        return view('guru.profile',['guru'=>$guru]);
    }

    public function index(Request $request){
        //dd($request->all());
        if($request->has('cari')){
            $data_guru = \App\guru:: where('nama','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_guru = \App\guru:: all();
        }
        return view ('guru.index',['data_guru' => $data_guru]);
    }

    public function create(Request $request)
    {   //return $request->all();
        $this->validate($request,[
            'nama' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'telpon' => 'required',
            'alamat' => 'required',
        ]);
    //insert ke table user
    $user = new \App\User;
    $user->role = 'guru';
    $user->name = $request->nama;
    $user->email = $request->email;
    $user->password = bcrypt ('guru');
    $user->remember_token = Str::random(60);
    $user->save();

    //insert ke table guru
    $request->request->add(['user_id' => $user->id]);
    $guru = \App\Guru::create($request->all());
    return redirect('/guru')->with('sukses','Data Berhasil Di Input');
    }

    //funct edit
    public function edit(guru $guru)
    {
        return view('guru.edit', ['guru'=>$guru]);
    }

    //funct update
    public function update(Request $request,guru $guru)
    {
            $guru->update($request->all());
            if($request->hasFile('avatar')){
                $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
                $guru->avatar = $request->file('avatar')->getClientOriginalName();
                $guru->save();
            }
            return redirect('guru/')->with('sukses','Data berhasil diupdate!');
    }
    
    //funct hapus/delete
    public function hapus(guru $guru){
        $guru->delete($guru);
        return redirect ('/guru')->with('sukses','Data Berhasil Di Hapus');
    }

    //funct export
    public function exportExcel() 
    {
        return Excel::download(new guruExport, 'guru.xlsx');
    }

    public function exportPdf(){
        $guru=guru:: all();
            $pdf= PDF::loadView('export.gurupdf',['guru'=>$guru]);
                return $pdf->download('guru.pdf');
    }

    public function gantiPass(ChangePasswordRequest $request, $idguru){
       $guru = \App\Guru::find($idguru);
       $user_id = auth()->user()->id;
       $old_password = auth()->user()->password;
       if(Hash::check($request->input('old_password'),$old_password)){
            $user = User::find($user_id);
            $user->password = Hash::make($request->input('password'));
            if($user->save()){
                return redirect('guru/'.$idguru. '/profile')->with('sukses','Password berhasil diganti!');
            }else{
                return redirect('guru/'.$idguru. '/profile')->with('gagal','Password tidak sama!');
            }
       }else{
            return redirect('guru/'.$idguru. '/profile')->with('gagal','Password tidak sama!');
        }
       
    }
}
