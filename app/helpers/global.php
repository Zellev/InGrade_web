<?php

use App\guru;
use App\siswa;

    function Rangking5Besar()
    {
    $siswa = siswa::all();
    $siswa->map(function($s){
        $s->rataRataNilai = $s->rataRataNilai();
        $s;
    });
    $siswa = $siswa -> sortByDesc('rataRataNilai')->take(10); 
    return $siswa;      
}

function totalsiswa(){
    return siswa::count();
}

function totalguru(){
    return guru::count();
}

/*function set_active($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';

}*/