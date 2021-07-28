@extends ('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                @if(session('sukses'))
                    <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                    </div>
                @endif    
                <div class="col-md-12">
                	<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Edit</h3>
								</div>
								<div class="panel-body">
                                <form action="/matpel/{{$mapel->id}}/update" method="POST" enctype="multipart/form-data">
                            		{{csrf_field()}}
		                            <div class="form-group">
		                                <label for="exampleInputEmail1">Kode Mata Pelajaran</label>
		                                <input name="kode" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kode Mapel" value="{{$mapel->kode}}">
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputEmail1">Nama Mata Pelajaran</label>
		                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Mapel" value="{{$mapel->nama}}">
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputEmail1">Semester</label>
		                                <input name="semester" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Semester Mapel" value="{{$mapel->semester}}">
		                            </div>
		                            
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