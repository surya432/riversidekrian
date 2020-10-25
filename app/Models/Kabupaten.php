<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'provinsi_id'];
    protected $hidden = ['deleted_at'];
    use \Illuminate\Database\Eloquent\SoftDeletes;
}
