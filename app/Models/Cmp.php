<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cmp extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'alamat', 'tipe', 'kecamatan_id', 'kabupaten_id', 'kelurahan_id', 'provinsi_id'];
    use \Illuminate\Database\Eloquent\SoftDeletes;
    public function provinsi()
    {
        return $this->belongsTo('\App\Models\Provinsi');
    }
    public function kabupaten()
    {
        return $this->belongsTo('\App\Models\Kabupaten');
    }

    public function kecamatan()
    {
        return $this->belongsTo('\App\Models\Kecamatan');
    }
    public function kelurahan()
    {
        return $this->belongsTo('\App\Models\Kelurahan');
    }
    public function warga()
    {
        return $this->hasMany('\App\Models\User')->with('roles')->limit(10);
    }
    public function rumah()
    {
        return $this->hasMany('App\Models\Homeuser');
    }
}
