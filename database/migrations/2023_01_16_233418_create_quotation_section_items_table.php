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
        Schema::create('quotation_section_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('quotation_id')->references('id')->on('quotations');
            $table->foreignUuid('item_id')->references('id')->on('quotation_items');

            $table->json('data')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_section_items');
    }
};
