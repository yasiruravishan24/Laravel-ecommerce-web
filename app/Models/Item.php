<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ItemSizes;
use App\Models\ItemCategory;
use App\Models\Review;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'brandName',
        'skuNo',
        'price',
        'quantity',
        'description',
        'imagePath',
    ];

    public function itemSizes(){
        return $this->hasMany(ItemSize::class);
    }
    public function itemCategory(){
        return $this->hasMany(ItemCategory::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function wishlists(){
        return $this->belongsToMany(Wishlist::class, 'wishlist_items');
    }
    public function carts(){
        return $this->belongsToMany(Cart::class, 'cart_item')
            ->withPivot('id','quantity', 'size');
    }
    public function order(){
        return $this->belongsToMany(Order::class, 'order_item')
            ->withPivot('id' ,'quantity', 'size');
    }
    public function invoice(){
        return $this->belongsToMany(Invoice::class, 'invoice_item')
            ->withPivot('id' ,'quantity', 'size');
    }
    public function returns(){
        return $this->belongsToMany(Returns::class, 'returns_item')
            ->withPivot('id' ,'quantity', 'size');
    }
}
