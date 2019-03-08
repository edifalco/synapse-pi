<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8250b86542cRelationshipsToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table) {
            if (!Schema::hasColumn('posts', 'idUser_id')) {
                $table->integer('idUser_id')->unsigned()->nullable();
                $table->foreign('idUser_id', '274855_5c81383cc3167')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('posts', 'idProject_id')) {
                $table->integer('idProject_id')->unsigned()->nullable();
                $table->foreign('idProject_id', '274855_5c81383cedbdc')->references('id')->on('projects')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {
            if(Schema::hasColumn('posts', 'idUser_id')) {
                $table->dropForeign('274855_5c81383cc3167');
                $table->dropIndex('274855_5c81383cc3167');
                $table->dropColumn('idUser_id');
            }
            if(Schema::hasColumn('posts', 'idProject_id')) {
                $table->dropForeign('274855_5c81383cedbdc');
                $table->dropIndex('274855_5c81383cedbdc');
                $table->dropColumn('idProject_id');
            }
            
        });
    }
}
