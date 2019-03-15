<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b9bda364baRelationshipsToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table) {
            if (!Schema::hasColumn('posts', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '274855_5c88d0eb94acd')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('posts', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274855_5c88d0ebabcd8')->references('id')->on('projects')->onDelete('cascade');
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
            if(Schema::hasColumn('posts', 'user_id')) {
                $table->dropForeign('274855_5c88d0eb94acd');
                $table->dropIndex('274855_5c88d0eb94acd');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('posts', 'project_id')) {
                $table->dropForeign('274855_5c88d0ebabcd8');
                $table->dropIndex('274855_5c88d0ebabcd8');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
