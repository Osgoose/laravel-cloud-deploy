<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\ShoppingListShare;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // POST /shopping-lists/{list}/products
   public function store(Request $request, $listId)
{
    $list = ShoppingList::findOrFail($listId);

    if (! $this->canEditList($list, $request)) {
        abort(403);
    }

    $data = $request->validate([
        'name' => ['required','string','max:255'],
        'emoji' => ['nullable','string','max:16'],
        'quantity' => ['required','integer','min:1'],
    ]);

    $product = Product::where('shopping_list_id', $list->id)
        ->where('name', $data['name'])
        ->where('emoji', $data['emoji'] ?? null)
        ->first();

    if ($product) {
        $product->increment('quantity', $data['quantity']);
    } else {
        $product = Product::create([
            'shopping_list_id' => $list->id,
            'name' => $data['name'],
            'emoji' => $data['emoji'] ?? null,
            'quantity' => $data['quantity'],
        ]);
    }

    // Mantente en la página (dashboard o shared) y preserva ?list
    return back()->with('status', 'Producto guardado');
}


    // POST /products/{id}/inc
public function inc(Request $request, $id)
{
    $product = Product::with('shoppingList')->findOrFail($id);
    if (! $this->canEditList($product->shoppingList, $request)) abort(403);

    $product->increment('quantity', 1);
    return back();
}

public function dec(Request $request, $id)
{
    $product = Product::with('shoppingList')->findOrFail($id);
    if (! $this->canEditList($product->shoppingList, $request)) abort(403);

    if ($product->quantity <= 1) {
        $product->delete();
        return back();
    }

    $product->decrement('quantity', 1);
    return back();
}

public function destroy(Request $request, $id)
{
    $product = Product::with('shoppingList')->findOrFail($id);
    if (! $this->canEditList($product->shoppingList, $request)) abort(403);

    $product->delete();
    return back()->with('status', 'Producto eliminado');
}

    protected function canEditList(ShoppingList $list, Request $request): bool
{
    if ((int)$list->user_id === (int)$request->user()->id) {
        return true;
    }

    return ShoppingListShare::where('shopping_list_id', $list->id)
        ->where('email', $request->user()->email)
        ->exists();
}
}
