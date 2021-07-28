@extends ('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="panel">              
								<div class="panel-heading">
                                    <h3 class="panel-title">Data Siswa </h3>
                                    <div class="right">
                                        <a href="/siswa/exportexcel" class="btn btn-sm btn-primary">export Excel</a>
                                        <a href="/siswa/exportpdf" class="btn btn-sm btn-primary">export Pdf</a>
                                        @if(auth()->user()->role == 'admin')
                                       <button type="button" class="btn btn-lg fa-stack" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-square fa-stack-1x"></i><i class="fa fa-plus fa-stack-1x fa-inverse"></i></button>
                                        @endif
                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
                                                <td>Nama Depan</td>
                                                <td>Nama Belakang</td>
                                                <td>Jenis Kelamin</td>
                                                <td>Agama</td>
                                                <td>Alamat</td>
                                                <td>rataRataNilai</td>
                                                <td>Aksi</td>
											</tr>
										</thead>
										<tbody>
                                        @foreach($data_siswa as $siswa)
                                            <tr>
                                                <td><a href="/siswa/{{$siswa->id}}/profile">{{$siswa->nama_depan}}</a></td>
                                                <td><a href="/siswa/{{$siswa->id}}/profile">{{$siswa->nama_belakang}}</a></td>
                                                <td>{{$siswa->jenis_kelamin}}</td>
                                                <td>{{$siswa->agama}}</td>
                                                <td>{{$siswa->alamat}}</td>
                                                <td>{{$siswa->rataRataNilai()}}</td>

                                                @if(auth()->user()->role == 'admin')
                                                <td><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                                                <td><a href="#" class="btn btn-danger btn-sm delete" siswa-id="{{$siswa->id}}">Hapus</a></td>
                                                @else
                                                <td><a href="/siswa/{{$siswa->id}}/profile" class="btn btn-info btn-md">Profil</a></td>
                                                @endif

                                            </tr>
                                        @endforeach
										</tbody>
									</table>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->role == 'admin')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/siswa/create" method="POST">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('nama_depan') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Nama Depan</label>
                    <input name="nama_depan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{old('nama_depan')}}">
                @if($errors->has('nama_depan'))
                    <span class="help-block">{{$errors-> first('nama_depan')}}</span>
                @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Belakang</label>
                    <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{old('nama_belakang')}}">
                </div>
                <div class="form-group{{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                    @if($errors->has('email'))
                    <span class="help-block">{{$errors-> first('email')}}</span>
                @endif
                </div>
                <div class="form-group{{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                    <option value="L"class="{{(old('jenis_kelamin') == 'L') ? ' selected' : ''}}">Laki-laki</option>
                    <option value="p" class="{{(old('jenis_kelamin') == 'P') ? ' selected' : ''}}">Perempuan</option>
                    </select>
                    @if($errors->has('jenis_kelamin'))
                    <span class="help-block">{{$errors-> first('jenis_kelamin')}}</span>
                @endif
                </div>
                <div class="form-group{{$errors->has('agama') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Agama</label>
                    <input name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Agama" value="{{old('agama')}}">
                </div>
                <div class="form-group">
                    <label  for="exampleFormControlTextarea1">Alamat</label>
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{old('alamat')}}"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            </div>
            @endif
        </div>
        </div>
@stop
@section('footer')
<script type="text/javascript">
$('.delete').click(function(){
            var siswa_id = $(this).attr('siswa-id');
            swal({
            title: "Apakah Anda Yakin??",
            text: "Ingin Menghapus Data Siswa dengan id "+siswa_id+ "??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                console.log(willDelete)
                if(willDelete){
                    window.location= "/siswa/"+siswa_id+"/hapus";
                }
            }
            });
    });
</script>
@stop