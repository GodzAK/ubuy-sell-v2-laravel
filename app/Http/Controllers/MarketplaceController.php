<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $categories = Item::CATEGORIES;

        $items = Item::query()
            ->approved()
            ->with('owner:id,username')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = '%' . $request->string('search') . '%';
                $query->where(function ($q) use ($term) {
                    $q->where('item_name', 'like', $term)
                        ->orWhere('item_description', 'like', $term);
                });
            })
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('marketplace.index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}
