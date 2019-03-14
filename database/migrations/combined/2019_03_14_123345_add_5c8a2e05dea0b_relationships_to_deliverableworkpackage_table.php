<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a2e05dea0bRelationshipsToDeliverableWorkpackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverable_workpackages', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverable_workpackages', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274838_5c81383482e2d')->references('id')->on('deliverables')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverable_workpackages', 'workpackage_id')) {
                $table->integer('workpackage_id')->unsigned()->nullable();
                $table->foreign('workpackage_id', '274838_5c813834b105a')->references('id')->on('workpackages')->onDelete('cascade');
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
        Schema::table('deliverable_workpackages', function(Blueprint $table) {
            if(Schema::hasColumn('deliverable_workpackages', 'deliverable_id')) {
                $table->dropForeign('274838_5c81383482e2d');
                $table->dropIndex('274838_5c81383482e2d');
                $table->dropColumn('deliverable_id');
            }
            if(Schema::hasColumn('deliverable_workpackages', 'workpackage_id')) {
                $table->dropForeign('274838_5c813834b105a');
                $table->dropIndex('274838_5c813834b105a');
                $table->dropColumn('workpackage_id');
            }
            
        });
    }
}
