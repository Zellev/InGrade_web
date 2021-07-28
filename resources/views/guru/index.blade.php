@extends ('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="panel">              
                                <div class="panel-heading">
                                    <h3 class="panel-title">Data Guru </h3>
                                    <div class="right">
                                        <a href="/guru/exportexcel" class="btn btn-sm btn-primary">export Excel</a>
                                        <a href="/guru/exportpdf" class="btn btn-sm btn-primary">export Pdf</a>
                                        @if(auth()->user()->role == 'admin')
                                       <button type="button" class="btn btn-lg fa-stack" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-square fa-stack-1x"></i><i class="fa fa-plus fa-stack-1x fa-inverse"></i></button>
                                        @endif
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td>Nama</td>
                                                <td>Telfun</td>
                                                <td>Alamat</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data_guru as $guru)
                                            <tr>
                                                <td><a href="/guru/{{$guru->id}}/profile">{{$guru->nama}}</a></td>
                                                <td>{{$guru->telpon}}</td>
                                                <td>{{$guru->alamat}}</td>

                                                @if(auth()->user()->role == 'admin')
                                                <td><a href="/guru/{{$guru->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
                                                <td><a href="#" class="btn btn-danger btn-sm delete" >Hapus</a></td>
                                                @else
                                                <td><a href="/guru/{{$guru->id}}/profile" class="btn btn-info btn-md">Profil</a></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Masukan Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/guru/create" method="POST">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('nama') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Nama</label>
                    <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama" value="{{old('nama')}}">
                @if($errors->has('nama'))
                    <span class="help-block">{{$errors-> first('nama_depan')}}</span>
                @endif
                </div>
                <div class="form-group{{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email'))
                    <span class="help-block">{{$errors-> first('email')}}</span>
                @endif
                </div>
                <div class="form-group{{$errors->has('telpon') ? 'has-error' : ''}}">
                    <label for="exampleInputEmail1">No-Telpon</label>
                    <input name="telpon" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telfon" value="{{old('telpon')}}">
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
    <script> 
    $('.delete').click(function(){
            var guru_id = $(this).attr('guru-id');
            swal({
            title: "Apakah Anda Yakin??",
            text: "Ingin Menghapus Data Siswa dengan id "+guru_id+ "??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                console.log(willDelete)
                if(willDelete){
                    window.location= "/guru/"+guru_id+"/hapus";
                }
            }
            });
    });
    </script>
    @stop
   
