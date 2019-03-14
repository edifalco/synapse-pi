<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a13e8a177cRelationshipsToDeliverableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverables', function(Blueprint $table) {
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
            if(Schema::hasColumn('deliverables', 'status_id')) {
                $table->dropForeign('274839_5c88eefc87043');
                $table->dropIndex('274839_5c88eefc87043');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('deliverables', 'project_id')) {
                $table->dropForeign('274839_5c8138354c508');
                $table->dropIndex('274839_5c8138354c508');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
