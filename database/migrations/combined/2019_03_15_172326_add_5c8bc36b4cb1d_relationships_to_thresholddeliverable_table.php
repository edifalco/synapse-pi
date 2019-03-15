<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8bc36b4cb1dRelationshipsToThresholdDeliverableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threshold_deliverables', function(Blueprint $table) {
            if (!Schema::hasColumn('threshold_deliverables', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274869_5c81384387b78')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('threshold_deliverables', function(Blueprint $table) {
            if(Schema::hasColumn('threshold_deliverables', 'project_id')) {
                $table->dropForeign('274869_5c81384387b78');
                $table->dropIndex('274869_5c81384387b78');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
