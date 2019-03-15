<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5c8b949b070585c8b949b03e70MemberRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('member_risk');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('member_risk')) {
            Schema::create('member_risk', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id', 'fk_p_274848_274866_risk_m_5c8b900b4dc02')->references('id')->on('members');
                $table->integer('risk_id')->unsigned()->nullable();
            $table->foreign('risk_id', 'fk_p_274866_274848_member_5c8b900b4eb92')->references('id')->on('risks');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
