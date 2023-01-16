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
        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', ['proposal', 'estimate'])
                ->default('proposal')
                ->comment('proposal for lead, and estimate for client');
            $table->foreignUuid('industry_id')->references('id')->on('organization_industries');

            $table->double('base_price')->comment('man hour price');
            $table->enum('risk_level', ['normal', 'medium', 'high'])->default('normal')
                ->comment('normal: {base_price} x 1, medium: {base_price} x 3, high: {base_price} x 5');

            $table->string('code_number')->comment('ex: 001/{QUO|EST|INV}/{PROJECT CODE}/IV/2023');
            $table->foreignUuid('contact_id')->references('id')->on('contacts');
            $table->date('valid_from');
            $table->date('valid_end');

            $table->text('description');
            $table->json('data')->nullable();

            $table->enum('status', ['draft', 'active'])->default('active');
            $table->boolean('is_template')->default(false);

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
        Schema::dropIfExists('quotations');
    }
};
