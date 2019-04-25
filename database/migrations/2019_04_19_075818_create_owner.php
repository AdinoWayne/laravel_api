<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('owner_id');
            $table->string('name');
            $table->string('person_name')->nullable();
            $table->string('add_text')->nullable();
            $table->string('email')->unique()->index();
            $table->string('tel')->nullable();
            $table->string('url')->nullable();
            $table->json('note')->nullable();
            $table->boolean('is_delete')->index()->default(false);
            $table->string('password');
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
        Schema::dropIfExists('Owner');
    }
}
