<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        DB::table('roles')->insert(
            array(
                'name' => 'Admin'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'Head of Office(Faculty)'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'Head of Office(Non-Teaching)'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'Faculty'
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'Non-Teaching'
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
        Schema::dropIfExists('roles');
    }
}
