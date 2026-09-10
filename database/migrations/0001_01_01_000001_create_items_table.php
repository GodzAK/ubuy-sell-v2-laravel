<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('item_name');
            $table->text('item_description');
            $table->decimal('price', 10, 2);
            $table->enum('category', ['Clothes', 'Footwear', 'School Supplies', 'Books', 'Others']);
            $table->enum('is_sold', ['Available', 'Sold'])->default('Available');
            $table->enum('item_is_approved', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('image')->nullable();
            $table->string('facebook_link')->nullable();
            $table->timestamps();

            $table->index(['item_is_approved', 'is_sold']);
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
