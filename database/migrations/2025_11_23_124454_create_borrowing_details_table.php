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
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrow_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('borrow_id')->references('id')->on('borrowings')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
    }
};
