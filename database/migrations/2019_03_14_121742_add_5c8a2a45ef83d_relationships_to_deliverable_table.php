<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a2a45ef83dRelationshipsToDeliverableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverables', 'workpackages_id')) {
                $table->integer('workpackages_id')->unsigned()->nullable();
                $table->foreign('workpackages_id', '274839_5c8a2902384b3')->references('id')->on('workpackages')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverables', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '274839_5c88eefc87043')->references('id')->on('deliverable_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverables', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274839_5c8138354c508')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('deliverables', function(Blueprint $table) {
            
        });
    }
}
