<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c86403a666b7RelationshipsToDeliverableWorkpackageTable extends Migration
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
            
        });
    }
}
