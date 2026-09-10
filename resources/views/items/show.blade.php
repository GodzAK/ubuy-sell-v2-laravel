@extends('layouts.app')

@section('title', $item->item_name)

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/item_details.css') }}">
<style>
    .status-Available { color: green; }
    .status-Sold { color: red; }
</style>
@endpush

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <h2>Item Details</h2>

    <div class="item-details">
        <p><strong>Status:</strong> <span class="status-{{ $item->is_sold }}">{{ $item->is_sold }}</span></p>

        <div class="item-image mb-3">
            <img src="{{ $item->imageUrl() }}" alt="{{ $item->item_name }}" style="max-width:400px;">
        </div>

        <div class="item-info">
            <h3>{{ $item->item_name }}</h3>
            <p><strong>Seller:</strong> {{ $item->owner->username }}</p>
            <p><strong>Description:</strong><br>{!! nl2br(e($item->item_description)) !!}</p>
            <p><strong>Price:</strong> ₱{{ number_format($item->price, 2) }}</p>

            @if ($item->facebook_link && !$isOwner)
                <form method="POST" action="{{ route('items.contact', $item) }}">
                    @csrf
                    <button type="submit" class="btn btn-facebook btn-primary">Contact Seller on Facebook</button>
                </form>
            @endif

            @if ($isOwner)
                <div class="item-actions mt-3">
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-primary">Edit Item</a>
                    <form method="POST" action="{{ route('items.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Item</button>
                    </form>
                </div>
            @endif

            @if ($isAdmin && !$isOwner)
                <div class="item-actions mt-3">
                    <form method="POST" action="{{ route('items.destroy', $item) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item as admin?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Item (admin)</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
