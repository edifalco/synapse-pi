<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c82631830b65RelationshipsToDeliverableDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverable_documents', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverable_documents', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274833_5c8138321198f')->references('id')->on('deliverables')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverable_documents', 'document_id')) {
                $table->integer('document_id')->unsigned()->nullable();
                $table->foreign('document_id', '274833_5c81383246ae8')->references('id')->on('documents')->onDelete('cascade');
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
        Schema::table('deliverable_documents', function(Blueprint $table) {
            
        });
    }
}
