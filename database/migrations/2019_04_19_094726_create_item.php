<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('owner_id');
            $table->string('name');
            $table->string('title');
            $table->string('job_point');
            $table->text('job_text');
            $table->string('job_category');
            $table->string('job_type');
            $table->string('salary');
            $table->string('salary_remarks');
            $table->string('add_display');
            $table->text('reason');
            $table->text('qualifications');
            $table->text('welfare');
            $table->json('note')->nullable();
            $table->string('images');
            $table->boolean('is_active');
            $table->boolean('is_delete');
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
        Schema::dropIfExists('Items');
    }
}
