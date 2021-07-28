@extends ('/layout/master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">               
                <div class="col-md-12">
                <div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Inputs</h3>
								</div>
								<div class="panel-body">
                                <form action="/guru/{{$guru->id}}/update" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Depan" value="{{$guru->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">No-Telfun</label>
                                <input name="telpon" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{$guru->telpon}}">
                            </div>                          
                            <div class="form-group">
                                <label  for="exampleFormControlTextarea1">Alamat</label>
                                <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$guru->alamat}}</textarea>
                            </div>
                            <!--div class="form-group">
                                <label  for="exampleFormControlTextarea1">Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div-->
                            <button type="submit" class="btn btn-warning">Update</button>
                                </form>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>     
@stop
