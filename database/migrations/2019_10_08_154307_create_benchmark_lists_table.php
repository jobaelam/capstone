<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenchmarkListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benchmark_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('benchmark_lists')->insert(
            array(
                'name' => 'System-Inputs And Processes'
            )
        );
        DB::table('benchmark_lists')->insert(
            array(
                'name' => 'Implementation'
            )
        );
        DB::table('benchmark_lists')->insert(
            array(
                'name' => 'Outcomes'
            )
        );
        DB::table('benchmark_lists')->insert(
            array(
                'name' => 'Best Practices'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benchmark_lists');
    }
}
