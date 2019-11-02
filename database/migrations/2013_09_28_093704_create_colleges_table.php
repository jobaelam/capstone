<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Computer Studies'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Science and Mathematics'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Engineering and Technology'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Education'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Arts and Science'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Business Administration and Accountancy'
            )
        );

        DB::table('colleges')->insert(
            array(
                'name' => 'College of Nursing'
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
        Schema::dropIfExists('colleges');
    }
}
