<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8ba1b8dcf88RelationshipsToCdScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_scores', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_scores', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274831_5c8138318a00d')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_scores', function(Blueprint $table) {
            if(Schema::hasColumn('cd_scores', 'project_id')) {
                $table->dropForeign('274831_5c8138318a00d');
                $table->dropIndex('274831_5c8138318a00d');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
