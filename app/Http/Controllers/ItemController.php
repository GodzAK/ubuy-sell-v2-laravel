<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function create()
    {
        return view('items.create', ['categories' => Item::CATEGORIES]);
    }

    public function store(StoreItemRequest $request)
    {
        $path = $request->file('image')->store('items', 'public');

        $item = $request->user()->items()->create([
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'price' => $request->price,
            'category' => $request->category,
            'facebook_link' => $request->facebook_link ?? $request->user()->facebook_link,
            'image' => basename($path),
            'is_sold' => 'Available',
            'item_is_approved' => 'Pending',
        ]);

        return redirect()->route('items.show', $item)
            ->with('status', 'Item submitted! An admin will review it before it appears in the marketplace.');
    }

    public function show(Item $item)
    {
        $item->load('owner:id,username');

        return view('items.show', [
            'item' => $item,
            'isOwner' => auth()->id() === $item->owner_id,
            'isAdmin' => auth()->check() && auth()->user()->isAdmin(),
        ]);
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);

        return view('items.edit', ['item' => $item, 'categories' => Item::CATEGORIES]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $data = $request->only(['item_name', 'item_description', 'price', 'category', 'is_sold', 'facebook_link']);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete('items/' . $item->image);
            }
            $data['image'] = basename($request->file('image')->store('items', 'public'));
        }

        $item->update($data);

        return redirect()->route('items.show', $item)
            ->with('status', $item->is_sold === 'Sold'
                ? "Item marked as sold. You may delete it once you're done."
                : 'Item updated successfully!');
    }

    public function destroy(Request $request, Item $item)
    {
        $this->authorize('delete', $item);

        if ($item->image) {
            Storage::disk('public')->delete('items/' . $item->image);
        }
        $item->delete();

        return redirect()->route('marketplace.index')->with('status', 'Item deleted successfully!');
    }

    public function contactSeller(Request $request, Item $item)
    {
        UserNotification::create([
            'user_id' => $item->owner_id,
            'message' => 'A user wants to contact you about your item: ' . $item->item_name,
        ]);

        $facebookUsername = preg_replace('/[^A-Za-z0-9._-]/', '', (string) $item->facebook_link);

        if ($facebookUsername === '') {
            return redirect()->route('items.show', $item)
                ->with('status', 'The seller has not linked a Facebook profile yet.');
        }

        return redirect()->away('https://www.facebook.com/' . rawurlencode($facebookUsername));
    }
}
