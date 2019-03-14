<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a290d08ab7RelationshipsToCdMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_meetings', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_meetings', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274830_5c8138314939e')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_meetings', function(Blueprint $table) {
            if(Schema::hasColumn('cd_meetings', 'project_id')) {
                $table->dropForeign('274830_5c8138314939e');
                $table->dropIndex('274830_5c8138314939e');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
