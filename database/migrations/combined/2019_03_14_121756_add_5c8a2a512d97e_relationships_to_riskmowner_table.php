<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a2a512d97eRelationshipsToRiskMownerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_mowners', function(Blueprint $table) {
            if (!Schema::hasColumn('risk_mowners', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274862_5c8138404e5d5')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risk_mowners', 'risk_id')) {
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', '274862_5c8138407e749')->references('id')->on('risks')->onDelete('cascade');
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
        Schema::table('risk_mowners', function(Blueprint $table) {
            if(Schema::hasColumn('risk_mowners', 'member_id')) {
                $table->dropForeign('274862_5c8138404e5d5');
                $table->dropIndex('274862_5c8138404e5d5');
                $table->dropColumn('member_id');
            }
            if(Schema::hasColumn('risk_mowners', 'risk_id')) {
                $table->dropForeign('274862_5c8138407e749');
                $table->dropIndex('274862_5c8138407e749');
                $table->dropColumn('risk_id');
            }
            
        });
    }
}
