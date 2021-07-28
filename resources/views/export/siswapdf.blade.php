<table class="table">
    <thead>
        <th>NAMA LENGKAP</th>
        <th>JENIS KELAMIN</th>
        <th>AGAMA</th>
        <th>RATA-RATA NILAI</th>
    </thead>
    <tbody>
        @foreach($siswa as $s)
        <tr>
            <td>{{$s->nama_lengkap()}}</td>
            <td>{{$s->jenis_kelamin}}</td>
            <td>{{$s->agama}}</td>
            <td>{{$s->rataRataNilai()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>