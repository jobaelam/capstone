<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenchmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benchmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('benchmark_name_id');
            $table->foreign('benchmark_name_id')->references('id')->on('benchmark_lists');
            $table->unsignedBigInteger('parameter_id');
            $table->foreign('parameter_id')->references('id')->on('parameters');
            $table->decimal('status',3,2)->default(0);
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
        Schema::dropIfExists('benchmarks');
    }
}
