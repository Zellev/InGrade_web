<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    protected $table  = ('pesan');
    protected $fillable = ['nama','email','no_telp','pesan'];

}
