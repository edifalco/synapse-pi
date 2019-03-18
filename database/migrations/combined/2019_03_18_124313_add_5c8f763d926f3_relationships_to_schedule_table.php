<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f763d926f3RelationshipsToScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function(Blueprint $table) {
            if (!Schema::hasColumn('schedules', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274867_5c813842f14f6')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('schedules', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '274867_5c8b7dd96b98d')->references('id')->on('schedule_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('schedules', 'highlight_id')) {
                $table->integer('highlight_id')->unsigned()->nullable();
                $table->foreign('highlight_id', '274867_5c8b7dd980278')->references('id')->on('schedule_highlights')->onDelete('cascade');
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
        Schema::table('schedules', function(Blueprint $table) {
            if(Schema::hasColumn('schedules', 'project_id')) {
                $table->dropForeign('274867_5c813842f14f6');
                $table->dropIndex('274867_5c813842f14f6');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('schedules', 'status_id')) {
                $table->dropForeign('274867_5c8b7dd96b98d');
                $table->dropIndex('274867_5c8b7dd96b98d');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('schedules', 'highlight_id')) {
                $table->dropForeign('274867_5c8b7dd980278');
                $table->dropIndex('274867_5c8b7dd980278');
                $table->dropColumn('highlight_id');
            }
            
        });
    }
}
