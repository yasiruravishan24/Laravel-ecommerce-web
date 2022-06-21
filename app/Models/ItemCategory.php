<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class ItemCategory extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'category'
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
