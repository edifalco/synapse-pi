<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8baa7c1f48bRelationshipsToRiskMreporterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_mreporters', function(Blueprint $table) {
            if (!Schema::hasColumn('risk_mreporters', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274863_5c813840d9aa5')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risk_mreporters', 'risk_id')) {
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', '274863_5c8138410eef4')->references('id')->on('risks')->onDelete('cascade');
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
        Schema::table('risk_mreporters', function(Blueprint $table) {
            if(Schema::hasColumn('risk_mreporters', 'member_id')) {
                $table->dropForeign('274863_5c813840d9aa5');
                $table->dropIndex('274863_5c813840d9aa5');
                $table->dropColumn('member_id');
            }
            if(Schema::hasColumn('risk_mreporters', 'risk_id')) {
                $table->dropForeign('274863_5c8138410eef4');
                $table->dropIndex('274863_5c8138410eef4');
                $table->dropColumn('risk_id');
            }
            
        });
    }
}
