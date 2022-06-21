<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }
    public function items(){
        return $this->belongsToMany(Item::class,'returns_item')
            ->withPivot('id' ,'quantity', 'size');
    }
}
