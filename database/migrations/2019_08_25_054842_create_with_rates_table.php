<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('with_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('version')->unique();
            $table->integer('rate');
            $table->timestamps();

            $table->unsignedBigInteger('service_stat_id');
            $table->foreign('service_stat_id')
                  ->references('id')
                  ->on('service_stats')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('with_rates');
    }
}
