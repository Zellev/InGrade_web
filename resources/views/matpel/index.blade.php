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
                                    <h3 class="panel-title">Data Mata Pelajaran </h3>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
                                                <td> Kode</td>
                                                <td> Nama Mata Pelajaran</td>
                                                <td> Semester</td>
                                                <td> ID-Pamong</td>
                                                <td> Aksi</td>
											</tr>
										</thead>
										<tbody>
                                        @foreach($data_mapel as $mapel)
                                            <tr>
                                                <td>{{$mapel->kode}}</td>
                                                <td>{{$mapel->nama}}</td>
                                                <td>{{$mapel->semester}}</td>
                                                <td>{{$mapel->guru_id}}</td>
                                                <td><a href="/matpel/{{$mapel->id}}/edit" class="btn btn-warning btn-sm">Edit</a></td>
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
@stop
   
