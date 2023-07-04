<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function company(){

        return $this->belongsTo(Company::class);
    }
    
    protected $fillable = [
        'product_name',
        'product_description',
        'product_model',
        'product_model_year',
        'product_price',
        'warranty_days',
        'warranty_extendable_days',
        'age_of_product',
        'return_days',
        'product_image',
        'product_policy',
        'category_id',
        'company_id',
        'IsActive',
        'IsDelete',
        'IsSold',
    ];
    
    protected $hidden = [
        'IsActive',
        'IsDelete',
        'IsSold',
    ];

    

}
