<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function deliver(){
        return $this->hasOne(Deliver::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function items(){
        return $this->belongsToMany(Item::class,'order_item')
            ->withPivot('id' ,'quantity', 'size');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function returns(){
        return $this->hasMany(Returns::class);
    }

}
