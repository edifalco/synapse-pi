<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c827d4372fc2RelationshipsToRiskPownerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_powners', function(Blueprint $table) {
            if (!Schema::hasColumn('risk_powners', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274864_5c8138416c7dd')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risk_powners', 'risk_id')) {
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', '274864_5c81384196a19')->references('id')->on('risks')->onDelete('cascade');
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
        Schema::table('risk_powners', function(Blueprint $table) {
            
        });
    }
}
