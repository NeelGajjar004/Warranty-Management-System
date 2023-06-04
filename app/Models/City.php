<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';

    public function vendors()
    {
        return $this->hasMany(Vendor::class,'city_id','id');
    }
    
}
