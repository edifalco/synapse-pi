<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f60273bd5dRelationshipsToProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_users', function(Blueprint $table) {
            if (!Schema::hasColumn('project_users', 'userID_id')) {
                $table->integer('userID_id')->unsigned()->nullable();
                $table->foreign('userID_id', '274858_5c81383ebfe29')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('project_users', 'projectID_id')) {
                $table->integer('projectID_id')->unsigned()->nullable();
                $table->foreign('projectID_id', '274858_5c81383f00de9')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('project_users', function(Blueprint $table) {
            if(Schema::hasColumn('project_users', 'userID_id')) {
                $table->dropForeign('274858_5c81383ebfe29');
                $table->dropIndex('274858_5c81383ebfe29');
                $table->dropColumn('userID_id');
            }
            if(Schema::hasColumn('project_users', 'projectID_id')) {
                $table->dropForeign('274858_5c81383f00de9');
                $table->dropIndex('274858_5c81383f00de9');
                $table->dropColumn('projectID_id');
            }
            
        });
    }
}
