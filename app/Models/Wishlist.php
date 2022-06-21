<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function items(){
        return $this->belongsToMany(Item::class,'wishlist_items');
    }
}
