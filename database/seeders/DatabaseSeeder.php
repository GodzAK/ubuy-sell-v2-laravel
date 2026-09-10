<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@ub.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_approved' => User::APPROVAL_APPROVED,
        ]);

        $seller = User::create([
            'username' => 'juan_delacruz',
            'email' => 'juan@ub.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_approved' => User::APPROVAL_APPROVED,
            'facebook_link' => 'juan.delacruz',
        ]);

        Item::create([
            'owner_id' => $seller->id,
            'item_name' => 'UB PE Uniform (Medium)',
            'item_description' => "Barely used PE uniform, size medium.\nNo stains, washed and ready.",
            'price' => 350,
            'category' => 'Clothes',
            'is_sold' => 'Available',
            'item_is_approved' => 'Approved',
            'facebook_link' => 'juan.delacruz',
        ]);

        Item::create([
            'owner_id' => $seller->id,
            'item_name' => 'Calculus Early Transcendentals (7th Ed.)',
            'item_description' => 'Textbook for Calc 1 & 2. Some highlights but all pages intact.',
            'price' => 500,
            'category' => 'Books',
            'is_sold' => 'Available',
            'item_is_approved' => 'Pending',
            'facebook_link' => 'juan.delacruz',
        ]);

        $this->command?->info("Seeded admin (admin@ub.edu.ph / password) and demo seller (juan@ub.edu.ph / password).");
    }
}
