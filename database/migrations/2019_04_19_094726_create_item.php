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
            $table->string('job_point')->nullable();
            $table->text('job_text')->nullable();
            $table->string('job_category')->nullable();
            $table->string('job_type')->nullable();
            $table->string('salary')->nullable();
            $table->string('salary_remarks')->nullable();
            $table->string('add_display')->nullable();
            $table->text('reason')->nullable();
            $table->text('qualifications')->nullable();
            $table->text('welfare')->nullable();
            $table->json('note')->nullable();
            $table->string('images')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_delete')->index()->default(false);
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
