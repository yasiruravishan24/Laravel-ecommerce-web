<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('returns_id')->constrained('returns')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns_item');
    }
}
