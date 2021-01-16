<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = [
        'deleted_at',
    ];
    public function detail()
    {
        return $this->hasMany('App\Models\DPengeluaran');
    }
}
