<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5c8a2578666425c8a257863003DeliverableMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('deliverable_member');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('deliverable_member')) {
            Schema::create('deliverable_member', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('deliverable_id')->unsigned()->nullable();
            $table->foreign('deliverable_id', 'fk_p_274839_274848_member_5c8a13e526c6a')->references('id')->on('deliverables');
                $table->integer('member_id')->unsigned()->nullable();
            $table->foreign('member_id', 'fk_p_274848_274839_delive_5c8a13e527a6c')->references('id')->on('members');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
