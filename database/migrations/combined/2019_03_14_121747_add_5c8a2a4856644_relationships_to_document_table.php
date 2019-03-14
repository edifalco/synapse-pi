<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a2a4856644RelationshipsToDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function(Blueprint $table) {
            if (!Schema::hasColumn('documents', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274841_5c813836621df')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('documents', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274841_5c8138369280e')->references('id')->on('deliverables')->onDelete('cascade');
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
        Schema::table('documents', function(Blueprint $table) {
            if(Schema::hasColumn('documents', 'project_id')) {
                $table->dropForeign('274841_5c813836621df');
                $table->dropIndex('274841_5c813836621df');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('documents', 'deliverable_id')) {
                $table->dropForeign('274841_5c8138369280e');
                $table->dropIndex('274841_5c8138369280e');
                $table->dropColumn('deliverable_id');
            }
            
        });
    }
}
