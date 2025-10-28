<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingListShare extends Model {
  protected $fillable = ['shopping_list_id','email'];
  public function list() { return $this->belongsTo(ShoppingList::class, 'shopping_list_id'); }
}
