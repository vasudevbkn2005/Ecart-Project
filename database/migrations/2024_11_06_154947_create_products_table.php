<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);  // Adjust as needed (10 digits total, 2 decimal places)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key for category
            $table->string('gallery')->nullable();  // Store image URLs as a JSON array
            $table->text('description')->nullable();  // Long text for product description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
