<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ShoppingList;
use App\Models\ShoppingListShare;

class SharedListsController extends Controller
{
    public function index(Request $request)
    {
        $email = Auth::user()->email;

        // Colección paginada de compartidas conmigo
        $shares = ShoppingListShare::query()
            ->where('email', $email)
            ->with(['list.products'])
            ->latest()
            ->paginate(24);

        $current = null;

        if ($request->filled('list')) {
            $listId = (int) $request->integer('list'); // sanitiza [web:253]
            $candidate = ShoppingList::with('products')->find($listId);

            if ($candidate) {
                $isOwner = (int)$candidate->user_id === (int)Auth::id();
                $isShared = ShoppingListShare::where('shopping_list_id', $candidate->id)
                    ->where('email', $email)
                    ->exists();

                if ($isOwner || $isShared) {
                    $current = $candidate;
                }
            }
        }

        return view('shared', compact('shares', 'current'));
    }

    // SharedListsController@store
public function store(Request $request, ShoppingList $list)
{
    $data = $request->validate([
        'email' => ['required','email','max:255'],
    ]);

    // Evitar compartirse a uno mismo
    if ($request->user()->email === $data['email']) {
        return back()
            ->withErrors(['email' => 'No puedes compartirte la lista a ti mismo.'])
            ->withInput();
    }

    if ($request->user()->id !== $list->user_id) {
        abort(403, 'Unauthorized');
    }

    ShoppingListShare::firstOrCreate([
        'shopping_list_id' => $list->id,
        'email' => $data['email'],
    ]);

    return back()->with('status', 'Lista compartida correctamente.');

}

public function unshareAll(Request $request, ShoppingList $list)
    {
        // solo el dueño puede
        if ((int)$list->user_id !== (int)$request->user()->id) {
            abort(403);
        }

        ShoppingListShare::where('shopping_list_id', $list->id)->delete();

        return back()->with('status', 'Se dejó de compartir esta lista con todos.');
    }

    // Receptor quita esta lista de sus compartidas
    public function unshareMe(Request $request, ShoppingList $list)
    {
        $email = $request->user()->email;

        // Si no estaba compartida contigo, no hay nada que borrar
        ShoppingListShare::where('shopping_list_id', $list->id)
            ->where('email', $email)
            ->delete();

        return redirect()->route('shared.lists')->with('status', 'Lista eliminada de tus compartidas.');
    }
}