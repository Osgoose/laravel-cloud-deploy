<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['shopping_list_id','name','emoji','quantity'];

public function shoppingList()
{
    return $this->belongsTo(ShoppingList::class, 'shopping_list_id');
}
}
