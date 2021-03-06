<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c8a257ac3f9cDeliverableMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('deliverable_member')) {
            Schema::create('deliverable_member', function (Blueprint $table) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', 'fk_p_274839_274848_member_5c8a257ac40b9')->references('id')->on('deliverables')->onDelete('cascade');
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', 'fk_p_274848_274839_delive_5c8a257ac414e')->references('id')->on('members')->onDelete('cascade');
                
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
        Schema::dropIfExists('deliverable_member');
    }
}
