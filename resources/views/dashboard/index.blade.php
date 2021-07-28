@extends ('layout.master')
@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                <div class="panel">
                        <div class="panel-heading">
                                    <h3 class="panel-title">Rangking 10 Besar</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <td>RANGKING</td>
                                                            <td>NAMA</td>
                                                            <td>NILAI</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $rangking = 1;
                                                        @endphp
                                                        @foreach(Rangking5Besar() as $s)
                                                        <tr>
                                                        <td>{{$rangking}}</td>
                                                        <td>{{$s->nama_lengkap()}}</td>
                                                        <td>{{$s->rataRataNilai}}</td>
                                                    </tr>
                                                    @php
                                                        $rangking ++;
                                                    @endphp
                                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-user fa-inverse"></i></span>
                                <p>
                                    <span class="number">{{totalsiswa()}}</span>
                                    <span class="title">Total Siswa</span>
                                </p>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-user fa-inverse"></i></span>
                                <p>
                                    <span class="number">{{totalguru()}}</span>
                                    <span class="title">Total Guru</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop