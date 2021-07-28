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
										<img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar" height="125" width="125">
										<h3 class="name">{{$siswa->nama_depan}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$siswa->mapel->count()}}<span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												{{$siswa->rataRataNilai()}}<span>Rata-rata</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Jenis Kelamin<span>{{$siswa->jenis_kelamin}}</span></li>
											<li>Agama <span>{{$siswa->agama}}</span></li>
											<li>Alamat<span>{{$siswa->alamat}}</span></li>
										</ul>
									</div>
									@if(auth()->user()->role != 'guru')
									<div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a>										
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#gantiPass">Ganti Password</button>	
									</div>
									@endif
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
							@if(auth()->user()->role != 'siswa')
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
								Tambah Nilai
							</button>
							@endif
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Mata Pelajaran</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>KODE</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Guru</th>
												<th>Nilai</th>
												@if(auth()->user()->role != 'siswa')
												<th>Aksi</th>
												@endif
											</tr>
										</thead>
										<tbody>
											@foreach($siswa->mapel as $mapel)
											<tr>
												<td>{{$mapel->kode}}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
												<td><a href="/guru/{{$mapel->guru_id}}/profile">{{$mapel->guru->nama}}</td>
												@if(auth()->user()->role != 'siswa')
												<td><a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}" data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukkan Nilai">{{$mapel->pivot->nilai}}</a></td>
												@else
												<td>{{$mapel->pivot->nilai}}</td>
												@endif
												@if(auth()->user()->role != 'siswa')
												<td><a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/deletenilai" class="btn
												btn-danger btn-sm" onclick="return confirm ('Yakin Mau Di hapus ?')">Hapus</td>
												@endif
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="panel">
									<div id="chartnilai"></div>
							</div>
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
            <form action="/siswa/{{$siswa->id}}/gantiPass" method="POST">
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

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<form action="/siswa/{{$siswa->id}}/addnilai" method="POST">
				{{csrf_field()}}
						<div class="form-group">
							<label for="mapel">Mata Pelajaran</label>
							<select class="form-control" id="mapel" name="mapel">
							@foreach($matapelajaran as $mp)
								<option value="{{$mp->id}}">{{$mp->nama}}</option>
							@endforeach
							</select>
						</div>
					<div class="form-group{{$errors->has('nilai') ? 'has-error' : ''}}">
						<label for="exampleInputEmail1">Nilai</label>
						<input name="nilai" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nilai" value="{{old('nilai')}}">
					@if($errors->has('nilai'))
						<span class="help-block">{{$errors-> first('nilai')}}</span>
					@endif
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
			</div>
		</div>
		</div>

@stop
@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	Highcharts.chart('chartnilai', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Laporan Nilai Siswa'
		},
		xAxis: {
			categories:{!!json_encode($categories)!!},
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Nilai'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Nilai',
			data:{!!json_encode($data)!!}
		}]
	});
</script>
	
@stop