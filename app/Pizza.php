<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name','price','category_id'];
    
    public function category()
    {
        return $this->belongsTo(PizzaCategory::class,'category_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_details');
    }
}
