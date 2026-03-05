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
        // Create allergens table
        Schema::create('allergens', function (Blueprint $table) {
            $table->id();
            $table->string('naam')->unique();
            $table->text('omschrijving')->nullable();
            $table->timestamps();
        });

        // Create products table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('naam')->unique();
            $table->string('barcode')->unique();
            $table->timestamps();
        });

        // Create contacts table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('straat');
            $table->string('huisnummer');
            $table->string('postcode');
            $table->string('stad');
            $table->timestamps();
        });

        // Create suppliers table
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('contact_persoon');
            $table->string('leverancier_nummer')->unique();
            $table->string('mobiel');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('set null');
            $table->timestamps();
        });

        // Create product_per_allergen junction table
        Schema::create('product_per_allergen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('allergen_id')->constrained('allergens')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['product_id', 'allergen_id']);
        });

        // Create magazine table
        Schema::create('magazine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('verpakkings_eenheid');
            $table->integer('aantal_aanwezig')->nullable();
            $table->timestamps();
        });

        // Create product_per_supplier table
        Schema::create('product_per_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->date('datum_levering');
            $table->integer('aantal');
            $table->date('datum_eerst_volgende_levering')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_per_supplier');
        Schema::dropIfExists('magazine');
        Schema::dropIfExists('product_per_allergen');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('products');
        Schema::dropIfExists('allergens');
    }
};
