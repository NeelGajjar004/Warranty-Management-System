<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    
    protected $fillable = [
        'vendor_name',
        'store_name',
        'vendor_email',
        'vendor_phone',
        'vendor_password',
        'vendor_address',
        'city_id',
        'vendor_pincode',
        'vendor_image',
        'gst_number',
        'IsActive',
        'IsDelete',
        'IsVerified',
        'IsBlock',
    ];
    
    protected $hidden = [
        'IsActive',
        'IsDelete',
        'IsVerified',
        'IsBlock',
    ];

    public function cities(){

        return $this->belongsTo(City::class,'city_id','id');
    }

    public function vencom(){

        return $this->hasMany(Vendors_Has_Companies::class,'vendor_id','id');
    }

    public function company(){
        return $this->hasMany(Company::class);
    }
}
