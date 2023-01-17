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
        Schema::create('quotation_sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('quotation_id')->references('id')->on('quotations');

            $table->text('title');
            $table->text('description')->nullable();
            $table->json('data')->nullable();

            $table->tinyInteger('order');

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
        Schema::dropIfExists('quotation_sections');
    }
};
