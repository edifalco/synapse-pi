<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c813f47da365RelationshipsToDeliverableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverables', 'idStatus_id')) {
                $table->integer('idStatus_id')->unsigned()->nullable();
                $table->foreign('idStatus_id', '274839_5c81383522cc2')->references('id')->on('deliverable_statuses')->onDelete('cascade');
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
            if(Schema::hasColumn('deliverables', 'idStatus_id')) {
                $table->dropForeign('274839_5c81383522cc2');
                $table->dropIndex('274839_5c81383522cc2');
                $table->dropColumn('idStatus_id');
            }
            if(Schema::hasColumn('deliverables', 'project_id')) {
                $table->dropForeign('274839_5c8138354c508');
                $table->dropIndex('274839_5c8138354c508');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
