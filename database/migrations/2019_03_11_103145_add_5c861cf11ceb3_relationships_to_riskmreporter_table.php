<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c861cf11ceb3RelationshipsToRiskMreporterTable extends Migration
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
            
        });
    }
}
