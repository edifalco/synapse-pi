<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a13250476bRelationshipsToMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function(Blueprint $table) {
            if (!Schema::hasColumn('members', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274848_5c81383a4ae44')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('members', function(Blueprint $table) {
            
        });
    }
}
