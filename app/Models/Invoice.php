<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');

    }
    public function items(){
        return $this->belongsToMany(Item::class,'invoice_item')
            ->withPivot('id' ,'quantity', 'size');
    }
}
