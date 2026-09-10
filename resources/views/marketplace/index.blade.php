@extends('layouts.app')

@section('title', 'Marketplace')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/marketplace.css') }}">
@endpush

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Marketplace</h2>
        <a href="{{ route('items.create') }}" class="btn btn-success">+ Sell an Item</a>
    </div>

    <div class="mb-4">
        <a href="{{ route('marketplace.index') }}" class="btn btn-sm {{ request('category') ? 'btn-outline-secondary' : 'btn-secondary' }}">All</a>
        @foreach ($categories as $category)
            <a href="{{ route('marketplace.index', ['category' => $category, 'search' => request('search')]) }}"
               class="btn btn-sm {{ request('category') === $category ? 'btn-secondary' : 'btn-outline-secondary' }}">{{ $category }}</a>
        @endforeach
    </div>

    <div class="row">
        @forelse ($items as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $item->imageUrl() }}" class="card-img-top" alt="{{ $item->item_name }}" style="height:180px;object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->item_name }}</h5>
                        <p class="card-text">₱{{ number_format($item->price, 2) }}</p>
                        <p class="text-muted small">{{ $item->category }} &middot; {{ $item->is_sold }}</p>
                        <a href="{{ route('items.show', $item) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No items found yet.</p>
        @endforelse
    </div>

    {{ $items->links() }}
</div>
@endsection
