<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table  = ('siswa');
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    public function mapel(){
        return $this->belongsToMany((Mapel::class))->withPivot(['nilai'])->withTimestamps();
    }
    
    public function rataRataNilai(){
        $total = 0;
        $hitung = 0;
        if($this->mapel->isNotEmpty()){
        foreach ($this->mapel as $mapel){
                $total += $mapel->pivot->nilai;
                $hitung++;
        }
        return $total!=0 ? round($total/$hitung): $total;
        }
        }
        public function nama_lengkap(){
            return $this->nama_depan.'  '.$this->nama_belakang;

        }
}
