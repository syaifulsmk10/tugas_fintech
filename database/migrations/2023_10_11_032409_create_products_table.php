<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100); // Ubah panjang kolom "name"
        $table->double('price', 8); // Ubah panjang dan presisi kolom price
        $table->integer('stock');
        $table->text('photo')->nullable();
        $table->text('description')->nullable();
        $table->foreignId('categories_id')->constrained(); // Sesuaikan penamaan tabel
        $table->char('stands', 5); // Ubah panjang kolom "stands"
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
