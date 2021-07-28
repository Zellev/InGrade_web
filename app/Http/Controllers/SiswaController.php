<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\siswaExport;
use App\Http\Requests\ChangePasswordRequest;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
Use Hash;
use App\User;
use App\Siswa;

class SiswaController extends Controller
{   

    public function index(Request $request){
        //dd($request->all());
        if($request->has('cari')){
            $data_siswa = \App\siswa:: where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_siswa = \App\siswa:: all();
        }
        return view ('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {   //return $request->all();
        $this->validate($request,[
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',

        ]);
    //insert ke table user
    $user = new \App\User;
    $user->role = 'siswa';
    $user->name = $request->nama_depan;
    $user->email = $request->email;
    $user->password = bcrypt ('null');
    $user->remember_token = Str::random(60);
    $user->save();

    //insert ke table siswa
    $request->request->add(['user_id' => $user->id]);
    $siswa = \App\siswa::create($request->all());
    return redirect('/siswa')->with('sukses','Data Berhasil Di Input');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa/edit', ['siswa'=>$siswa]);
    }

    public function update(Request $request,Siswa $siswa)
    {
            $siswa->update($request->all());
            if($request->hasFile('avatar')){
                $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
                $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                $siswa->save();
            }
            return redirect('/siswa')->with('sukses','Data Berhasil Di Update');
    }

    public function hapus(Siswa $siswa){
		$siswa->delete($siswa);
        return redirect ('/siswa')->with('sukses','Data Berhasil Di Hapus');
    }

    public function profile(Siswa $siswa){
        $matapelajaran = \App\mapel:: all();

        //menyiapkan data untuk chart
        $categories = [];
        $data = [];
        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }
        return view('siswa.profile',['siswa'=>$siswa, 'matapelajaran'=>$matapelajaran, 'categories'=>$categories, 'data'=> $data]);

    }

     public function profile_ku(Siswa $siswa){
        $matapelajaran = \App\mapel:: all();

        //menyiapkan data untuk chart
        $categories = [];
        $data = [];
        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }
        return view('siswa.profile',['siswa'=>$siswa, 'matapelajaran'=>$matapelajaran, 'categories'=>$categories, 'data'=> $data]);

    }
    
    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa. '/profile')->with('error','Mata Pelajaran Sudah Ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' =>$request->nilai]);
            return redirect('siswa/'.$idsiswa. '/profile')->with('sukses','Data Berhasil Di Masukan');
        }

        public function deletenilai(Siswa $siswa, $idmapel){
            $siswa->mapel()->detach($idmapel);
            return redirect()->back()->with('Mata Pelajaran Berhasil Dihapus');
        }
            public function exportExcel() 
            {
                return Excel::download(new siswaExport, 'siswa.xlsx');
            }
            public function exportPdf(){
                $siswa=siswa:: all();
                    $pdf= PDF::loadView('export.siswapdf',['siswa'=>$siswa]);
                        return $pdf->download('siswa.pdf');
            }

    public function gantiPass(ChangePasswordRequest $request, $idsiswa){
       $siswa = \App\Siswa::find($idsiswa);
       $user_id = auth()->user()->id;
       $old_password = auth()->user()->password;
       if(Hash::check($request->input('old_password'),$old_password)){
            $user = User::find($user_id);
            $user->password = Hash::make($request->input('password'));
            if($user->save()){
                return redirect('siswa/'.$idsiswa. '/profile')->with('sukses','Password berhasil diganti!');
            }else{
                return redirect('siswa/'.$idsiswa. '/profile')->with('gagal','Password tidak sama!');
            }
       }else{
            return redirect('siswa/'.$idsiswa. '/profile')->with('gagal','Password tidak sama!');
        }
       
    }
}

