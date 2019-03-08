<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c827e7ad87e8RelationshipsToRiskPreporterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_preporters', function(Blueprint $table) {
            if (!Schema::hasColumn('risk_preporters', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274865_5c81384219464')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risk_preporters', 'risk_id')) {
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', '274865_5c81384249f2d')->references('id')->on('risks')->onDelete('cascade');
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
        Schema::table('risk_preporters', function(Blueprint $table) {
            
        });
    }
}
