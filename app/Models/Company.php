<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';

            
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_description',
        'company_logo',
        'IsActive',
    ];

    protected $hidden = [
        'IsActive',
    ];

    public function product(){

        return $this->hasMany(Product::class);
    }

    public function vencom(){

        return $this->hasMany(Vendors_Has_Companies::class,'company_id','id');
    }

    public function vendor(){
        return $this->hasMany(Vendor::class);
    }
    
}
