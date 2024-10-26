<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatorResultsTable extends Migration
{
    public function up()
    {
        Schema::create('calculator_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('selected_categories');
            $table->json('selected_items');
            $table->integer('total_co2');
            $table->integer('reduced_co2')->nullable();
            $table->integer('difference')->nullable();
            $table->timestamp('calculation_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculator_results');
    }
}

