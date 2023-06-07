<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_password',
        'date_of_birth',
        'customer_image',
        'country_id',
        'state_id',
        'city_id',
        'IsActive',
        'IsDelete',
    ];
    
    protected $hidden = [
        'IsActive',
        'IsDelete',
    ];

    public function countrys()
    {
        return $this->belongsTo(Country::Class,'country_id','id');
    }
    public function states()
    {
        return $this->belongsTo(State::Class,'state_id','id');
    }
    public function cities()
    {
        return $this->belongsTo(City::Class,'city_id','id');
    }
}
