<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\ShoppingListShare;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    // GET /dashboard?list={id} para mostrar detalle
    public function index(Request $request)
    {
        $user = $request->user();
        $lists = ShoppingList::with('products')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        $current = null;
        if ($request->filled('list')) {
            $current = ShoppingList::with('products')
                ->where('id', $request->integer('list'))
                ->where('user_id', $user->id)
                ->first();
            if (!$current) {
                return redirect()->route('dashboard');
            }
        }

        return view('dashboard', [
            'lists' => $lists,
            'current' => $current,
        ]);
    }

    // POST /shopping-lists
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
        ]);

        $list = ShoppingList::create([
            'user_id' => $request->user()->id,
            'name' => $data['name'],
            'emoji' => '📝',
        ]);

        return redirect()->route('dashboard', ['list' => $list->id]);
    }

    // POST /shopping-lists/{id}/update
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
        ]);

        $list = ShoppingList::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $list->update(['name' => $data['name']]);

        return redirect()->route('dashboard', ['list' => $list->id]);
    }

    // POST /shopping-lists/{id}/delete
    public function destroy(Request $request, $id)
    {
        $list = ShoppingList::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $list->delete();

        return redirect()->route('dashboard');
    }

    public function share(Request $request, int $id)
{
    $data = $request->validate([
        'email' => ['required','email','max:255'],
    ]);

    // Verifica autorización si procede (solo dueño puede compartir)
    $list = \App\Models\ShoppingList::findOrFail($id);
    $this->canEditList($list, $request);

    ShoppingListShare::firstOrCreate([
        'shopping_list_id' => $list->id,
        'email' => $data['email'],
    ]);

    return back()->with('status', 'Lista compartida.');
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

