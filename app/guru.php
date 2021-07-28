<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $table= 'guru';
    protected $fillable = ['user_id','nama', 'telpon', 'alamat','avatar'];

    public function mapel(){
       return $this->hasMany(Mapel::class);
    }

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

}