<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_property_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('property_id');
            $table->string('value');

            $table->unique(['product_id', 'property_id', 'value']);

            $table->index('product_id', 'product_property_value_product_idx');
            $table->index('property_id', 'product_property_value_property_idx');

            $table->foreign('product_id', 'product_property_value_product_fk')->on('products')->references('id')
                ->cascadeOnDelete();
            $table->foreign('property_id', 'product_property_value_property_fk')->on('product_properties')->references('id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_property_values');
    }
};
