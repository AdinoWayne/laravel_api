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
        Schema::create('Owner', function (Blueprint $table) {
            $table->string('id');
            $table->string('owner_id');
            $table->string('name');
            $table->string('person_name');
            $table->string('add_text');
            $table->string('email');
            $table->string('tel');
            $table->string('url');
            $table->string('note')->nullable();
            $table->string('pass');
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
