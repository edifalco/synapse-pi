<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8b90205b4e9MemberRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('member_risk')) {
            Schema::create('member_risk', function (Blueprint $table) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', 'fk_p_274848_274866_risk_m_5c8b90205b5dc')->references('id')->on('members')->onDelete('cascade');
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', 'fk_p_274866_274848_member_5c8b90205b66f')->references('id')->on('risks')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_risk');
    }
}
