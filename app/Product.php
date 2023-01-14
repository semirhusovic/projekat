<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

//    public function shops()
//    {
//        return $this->hasMany(Shop::class, 'created_by_id', 'id');
//    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
