<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeuser extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    public function homes()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
