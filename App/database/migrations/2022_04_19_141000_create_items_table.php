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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default("NOT_APPROVED");
            $table->string('type');
            $table->foreignId('category_id');
            $table->foreignId('user_id');
            $table->text('description');
            $table->double('price');
            $table->string('currency');
            $table->integer('amount');
            $table->string('city');
            $table->string('files')->nullable();
            $table->date("end_time")->nullable();
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
        Schema::dropIfExists('items');
    }
};
