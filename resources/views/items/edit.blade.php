@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="container" style="max-width:600px; margin-top:130px; margin-bottom:80px;">
    <h2>Edit Item</h2>
    <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" id="item_name" name="item_name" class="form-control" value="{{ old('item_name', $item->item_name) }}" required>
        </div>
        <div class="form-group">
            <label for="item_description">Description</label>
            <textarea id="item_description" name="item_description" class="form-control" rows="4" required>{{ old('item_description', $item->item_description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price (₱)</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0.01" value="{{ old('price', $item->price) }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category', $item->category) === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="is_sold">Status</label>
            <select id="is_sold" name="is_sold" class="form-control" required>
                <option value="Available" @selected(old('is_sold', $item->is_sold) === 'Available')>Available</option>
                <option value="Sold" @selected(old('is_sold', $item->is_sold) === 'Sold')>Sold</option>
            </select>
        </div>
        <div class="form-group">
            <label for="facebook_link">Facebook username</label>
            <input type="text" id="facebook_link" name="facebook_link" class="form-control" value="{{ old('facebook_link', $item->facebook_link) }}">
        </div>
        <div class="form-group">
            <label for="image">Replace photo (optional)</label>
            <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Update Item</button>
        <a href="{{ route('items.show', $item) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
