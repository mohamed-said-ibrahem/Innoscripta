<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total','address','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class,'order_details')->withPivot(['quantity']);
    }

}
