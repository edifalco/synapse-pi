<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8a491117f6dRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->integer('role_id')->unsigned()->nullable();
                $table->foreign('role_id', 'fk_p_274820_274821_user_r_5c8a491118111')->references('id')->on('roles')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_274821_274820_role_u_5c8a4911181f4')->references('id')->on('users')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
