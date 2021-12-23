<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['product_photo','category_id','subcategory_id','product_name','product_price','product_desp','product_quantity'];

    function relation_to_category_has_one(){
        return $this->hasOne(category::class, 'id', 'category_id');
    }

    function relation_to_subcategory_has_one(){
        return $this->hasOne(subcategory::class, 'id', 'subcategory_id');
    }

}
