<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'warranty_period',
        'product_image',
        'category_id',
        'company_id',
        'IsActive',
    ];

    protected $hidden = [
        'IsActive',
    ];

    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function company(){

        return $this->belongsTo(Company::class);
    }

}
