<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $hidden = ['deleted_at'];
}
