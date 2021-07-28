@extends ('layout.master')
@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{asset('images/default.png')}}" class="img-circle" alt="Avatar">
										<h3 class="name">{{$guru->nama}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>No-Telpon<span>{{$guru->telpon}}</span></li>
											<li>Alamat<span>{{$guru->alamat}}</span></li>						
										</ul>
									</div>
									@if(auth()->user()->role != 'siswa')
									<div class="text-center"><a href="/guru/{{$guru->id}}/edit" class="btn btn-warning">Edit Profile</a>										
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#gantiPass">Ganti Password</button>	
									</div>
									@endif
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
									<div class="panel">
										<div class="panel-heading">
											<h3 class="panel-title">Mata Pelajaran Yang Di Ajarkan {{$guru->nama}}</h3>
										</div>
										<div class="panel-body">
											<table class="table table-striped">
												<thead>
													<tr>
		                                                <th>Nama</th>
		                                                <th>Semester</th>
													</tr>
												</thead>
												<tbody>
		                                            @foreach($guru->mapel as $mapel)
		                                            <tr>
		                                                <td>{{$mapel->nama}}</td>
		                                                <td>{{$mapel->semester}}</td>
		                                            </tr>
		                                            @endforeach
												</tbody>
											</table>
										</div>
									</div><br><br><br><br><br><br><br>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- Modal Ganti pass-->
		<div class="modal fade" id="gantiPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/guru/{{$guru->id}}/gantiPass" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Awal</label>
                    <input name="old_password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password awal">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password Baru</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password Baru">
                    @error('password')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Konfirmasi Password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ganti Password</button>
            </div>
            </form>
            </div>
         </div>
        </div>
		<!--END pass-->
@stop

