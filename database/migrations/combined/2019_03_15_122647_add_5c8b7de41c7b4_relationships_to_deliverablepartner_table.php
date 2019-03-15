<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b7de41c7b4RelationshipsToDeliverablePartnerTable extends Migration
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
            if(Schema::hasColumn('deliverable_partners', 'partner_id')) {
                $table->dropForeign('274835_5c81383351453');
                $table->dropIndex('274835_5c81383351453');
                $table->dropColumn('partner_id');
            }
            if(Schema::hasColumn('deliverable_partners', 'deliverable_id')) {
                $table->dropForeign('274835_5c81383374e14');
                $table->dropIndex('274835_5c81383374e14');
                $table->dropColumn('deliverable_id');
            }
            
        });
    }
}
