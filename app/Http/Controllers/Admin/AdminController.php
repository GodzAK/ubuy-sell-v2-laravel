<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function pendingUsers()
    {
        $users = User::where('is_approved', User::APPROVAL_PENDING)
            ->where('role', '!=', 'admin')
            ->latest()
            ->paginate(10);

        return view('admin.users', ['users' => $users]);
    }

    public function approveUser(Request $request, User $user)
    {
        $user->update([
            'is_approved' => $request->boolean('approve') ? User::APPROVAL_APPROVED : User::APPROVAL_REJECTED,
        ]);

        return back()->with('status', $request->boolean('approve')
            ? 'User has been approved successfully!'
            : 'User has been rejected and will remain in history.');
    }

    public function pendingItems()
    {
        $items = Item::pendingApproval()->with('owner:id,username')->latest()->paginate(10);

        return view('admin.items', ['items' => $items]);
    }

    public function approveItem(Request $request, Item $item)
    {
        $item->update([
            'item_is_approved' => $request->boolean('approve') ? 'Approved' : 'Rejected',
        ]);

        return back()->with('status', $request->boolean('approve')
            ? 'Item has been approved successfully!'
            : 'Item has been rejected.');
    }

    public function history()
    {
        $userHistory = User::where('is_approved', '!=', User::APPROVAL_PENDING)
            ->where('role', '!=', 'admin')
            ->latest()
            ->paginate(10, ['*'], 'users_page');

        $itemHistory = Item::whereIn('item_is_approved', ['Approved', 'Rejected'])
            ->with('owner:id,username')
            ->latest()
            ->paginate(10, ['*'], 'items_page');

        return view('admin.history', compact('userHistory', 'itemHistory'));
    }
}
