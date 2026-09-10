@extends('layouts.app')

@section('title', 'Sell an Item')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/sell_item.css') }}">
@endpush

@section('content')
<div class="container" style="max-width:600px; margin-top:130px; margin-bottom:80px;">
    <h2>Sell an Item</h2>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" id="item_name" name="item_name" class="form-control" value="{{ old('item_name') }}" required>
        </div>
        <div class="form-group">
            <label for="item_description">Description</label>
            <textarea id="item_description" name="item_description" class="form-control" rows="4" required>{{ old('item_description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price (₱)</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0.01" value="{{ old('price') }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="facebook_link">Facebook username (for buyers to contact you)</label>
            <input type="text" id="facebook_link" name="facebook_link" class="form-control" value="{{ old('facebook_link', auth()->user()->facebook_link) }}">
        </div>
        <div class="form-group">
            <label for="image">Photo</label>
            <input type="file" id="image" name="image" class="form-control-file" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Submit for Approval</button>
    </form>
</div>
@endsection
