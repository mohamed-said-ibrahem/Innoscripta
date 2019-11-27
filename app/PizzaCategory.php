<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaCategory extends Model
{
    protected $fillable = ['name','description'];
    public function pizzas()
    {
        return $this->hasMany(Pizza::class);
    }
}
