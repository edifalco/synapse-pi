<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c813a44b9efeRelationshipsToDeliverablePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverable_partners', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverable_partners', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274835_5c81383351453')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverable_partners', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274835_5c81383374e14')->references('id')->on('deliverables')->onDelete('cascade');
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
        Schema::table('deliverable_partners', function(Blueprint $table) {
            
        });
    }
}
