<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDPackages extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $guarded = ['id'];
}
