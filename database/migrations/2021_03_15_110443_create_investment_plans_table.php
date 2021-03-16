<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->decimal('min_amount', 15);
            $table->decimal('max_amount', 15);
            $table->unsignedInteger('duration')->default(7);
            $table->unsignedInteger('cycles')->default(1);
            $table->unsignedInteger('percentage')->default(15);
            $table->decimal('bonus')->nullable();
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
        Schema::dropIfExists('investment_plans');
    }
}
