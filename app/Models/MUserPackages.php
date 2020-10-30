<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MUserPackages extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = [
        'deleted_at',
    ];
    public function Payment()
    {
        return $this->belongsTo('App\Models\MPackages', 'm_packages_id')->with('detailpayment');
    }

    public function userdetail()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->with('cmpdetail');
    }
}
