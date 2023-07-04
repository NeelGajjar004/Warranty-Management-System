<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendors_Has_Companies extends Model
{
    use HasFactory;
    protected $table = 'vendors_has_companies';

    protected $fillable = [
        'vendor_id',
        'company_id',
    ];

    public function vendor(){

        return $this->hasMany(Vendor::class);
    }

    public function company(){

        return $this->hasMany(Company::class);
    }
}
