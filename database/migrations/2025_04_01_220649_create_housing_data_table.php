<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('housing_data', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('area')->nullable();
            $table->integer('average_price')->nullable();
            $table->string('code')->nullable();
            $table->integer('houses_sold')->nullable();
            $table->float('no_of_crimes')->nullable();
            $table->boolean('borough_flag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('housing_data');
    }
};
