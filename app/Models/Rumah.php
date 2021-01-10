<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    public function typerumah()
    {
        return $this->belongsTo('App\Models\Typerumah', 'typerumah_id');
    }
    public function tenants()
    {
        return $this->hasMany('App\Models\HomeUser', 'rumah_id');
    }
}
