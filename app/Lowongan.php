<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = ['nama_low','tgl_mulai','lokasi','gaji','deskripsi_iklan','pers_id'];
    public $timestamps = true;

    public function Perusahaan(){
        return $this->belongstoMany('App\Perusahaan','pers_id');
    }
    public function Lamaran(){
        return $this->HasOne('App\Lamaran','low_id');
    }
}
