<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public const CATEGORIES = ['Clothes', 'Footwear', 'School Supplies', 'Books', 'Others'];

    protected $fillable = [
        'owner_id',
        'item_name',
        'item_description',
        'price',
        'category',
        'is_sold',
        'item_is_approved',
        'image',
        'facebook_link',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('item_is_approved', 'Approved');
    }

    public function scopePendingApproval($query)
    {
        return $query->where('item_is_approved', 'Pending');
    }

    public function imageUrl(): string
    {
        return $this->image
            ? asset('storage/items/' . $this->image)
            : asset('assets/images/example.png');
    }
}
