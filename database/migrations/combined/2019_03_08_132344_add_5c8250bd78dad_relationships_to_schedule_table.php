<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8250bd78dadRelationshipsToScheduleTable extends Migration
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
            
        });
    }
}
