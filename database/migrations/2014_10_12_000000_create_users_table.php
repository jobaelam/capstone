<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->unsignedBigInteger('office_department_id')->nullable();
            $table->foreign('office_department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'last_name' => 'Admin',
                'first_name' => 'Admin',
                'middle_name' => 'Admin',
                'role_id' => '1',
                'email' => 'admin',
                'password' => Hash::make('admin'),
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        //Information Technology
        DB::table('users')->insert(
            array(
                'first_name' => 'Lomesindo',
                'last_name' => 'Caparida',
                'email' => 'caparida@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '1',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Mia Amor',
                'last_name' => 'Catindig',
                'email' => 'catindig@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '1',
                'role_id' => '2',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'January',
                'last_name' => 'Febro',
                'email' => 'febro@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '1',
                'role_id' => '1',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Haron Hakeen',
                'last_name' => 'Lua',
                'email' => 'lua@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '1',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Manuel',
                'last_name' => 'Cabido',
                'email' => 'cabido@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '1',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );
        //Computer Studies
        DB::table('users')->insert(
            array(
                'first_name' => 'Renato',
                'last_name' => 'Crisostomo',
                'email' => 'crisostomo@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '2',
                'role_id' => '2',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Malikey',
                'last_name' => 'Maulana',
                'email' => 'maulana@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '2',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Darlene Daryl',
                'last_name' => 'Obach',
                'email' => 'obach@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '2',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Julieto',
                'last_name' => 'Perez',
                'email' => 'perez@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '2',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Jennifer Joyce',
                'last_name' => 'Montemayor',
                'email' => 'montemayor@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '2',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );
        //Electronics Engineering Tech
        DB::table('users')->insert(
            array(
                'first_name' => 'Antonio',
                'last_name' => 'Marajas',
                'email' => 'marajas@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '3',
                'role_id' => '2',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Rolando',
                'last_name' => 'Galucan',
                'email' => 'galucan@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '3',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Alexander',
                'last_name' => 'Gaw',
                'email' => 'gaw@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '3',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Ofelia',
                'last_name' => 'Mendoza',
                'email' => 'mendoza@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '3',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
            )
        );

        DB::table('users')->insert(
            array(
                'first_name' => 'Michael',
                'last_name' => 'Nabua',
                'email' => 'nabua@gmail.com',
                'password' => Hash::make('1234'),
                'office_department_id' => '3',
                'role_id' => '4',
                'profile_image' => 'http://via.placeholder.com/150x150',
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
        Schema::dropIfExists('users');
    }
}
