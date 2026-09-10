@extends('layouts.app')

@section('title', 'Approval History')

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <a href="{{ route('admin.dashboard') }}">&larr; Back to Admin Dashboard</a>

    <h3 class="mt-3">User Approval History</h3>
    <table class="table table-striped">
        <thead><tr><th>Username</th><th>Email</th><th>Status</th></tr></thead>
        <tbody>
            @forelse ($userHistory as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_approved == 1 ? 'Approved' : 'Rejected' }}</td>
                </tr>
            @empty
                <tr><td colspan="3">No history yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $userHistory->links() }}

    <h3 class="mt-5">Seller Item Approval History</h3>
    <table class="table table-striped">
        <thead><tr><th>Item Name</th><th>Price</th><th>Status</th><th>Image</th></tr></thead>
        <tbody>
            @forelse ($itemHistory as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->item_is_approved }}</td>
                    <td><img src="{{ $item->imageUrl() }}" alt="{{ $item->item_name }}" style="max-height:100px;"></td>
                </tr>
            @empty
                <tr><td colspan="4">No history yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $itemHistory->links() }}
</div>
@endsection
