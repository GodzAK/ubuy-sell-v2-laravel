@extends('layouts.app')

@section('title', 'Item Approvals')

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <a href="{{ route('admin.dashboard') }}">&larr; Back to Admin Dashboard</a>
    <h3 class="mt-3">Seller Item Approval</h3>
    <table class="table table-striped">
        <thead>
            <tr><th>Item Name</th><th>Price</th><th>Status</th><th>Image</th><th>Action</th></tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->item_is_approved }}</td>
                    <td><img src="{{ $item->imageUrl() }}" alt="{{ $item->item_name }}" width="100"></td>
                    <td>
                        <form method="POST" action="{{ route('admin.items.approve', $item) }}" style="display:inline;">
                            @csrf
                            <input type="hidden" name="approve" value="1">
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.items.approve', $item) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <input type="hidden" name="approve" value="0">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No pending items.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $items->links() }}
</div>
@endsection
