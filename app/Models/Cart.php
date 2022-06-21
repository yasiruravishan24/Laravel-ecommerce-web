<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function items(){
        return $this->belongsToMany(Item::class,'cart_item')
            ->withPivot('id','quantity', 'size');
    }
}
