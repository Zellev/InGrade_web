<table class="table">
    <thead>
        <th>NAMA</th>
        <th>NO-TELP</th>
        <th>ALAMAT</th>
    </thead>
    <tbody>
        @foreach($guru as $g)
        <tr>
            <td>{{$g->nama}}</td>
            <td>{{$g->telpon}}</td>
            <td>{{$g->alamat}}</td>
        </tr>
        @endforeach
    </tbody>
</table>