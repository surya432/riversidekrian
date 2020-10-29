<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPackages extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $fillable = ['name', 'tipe', 'date', 'duedate', 'totalTagihan', 'create_by', 'cmp_id', 'status', 'tipe', 'update_by'];
    // protected $guarded = ['id'];
}
