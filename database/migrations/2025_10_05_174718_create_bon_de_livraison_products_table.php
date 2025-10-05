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
        if(!Schema::hasTable('bon_de_livraison_products'))
        {
            Schema::create('bon_de_livraison_products', function (Blueprint $table) {
                $table->id();
                $table->integer('bon_de_livraison_id');
                $table->string('product_type')->nullable();
                $table->integer('product_id');
                $table->integer('quantity');
                $table->string('tax')->nullable();
                $table->float('discount')->default('0.00');
                $table->float('price')->default('0.00');
                $table->longText('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_de_livraison_products');
    }
};
