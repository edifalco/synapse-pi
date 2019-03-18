<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f595aa3dd7RelationshipsToProjectPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_periods', function(Blueprint $table) {
            if (!Schema::hasColumn('project_periods', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '276692_5c87e993df568')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('project_periods', function(Blueprint $table) {
            if(Schema::hasColumn('project_periods', 'project_id')) {
                $table->dropForeign('276692_5c87e993df568');
                $table->dropIndex('276692_5c87e993df568');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
