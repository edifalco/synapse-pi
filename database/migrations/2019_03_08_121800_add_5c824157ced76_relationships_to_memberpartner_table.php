<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c824157ced76RelationshipsToMemberPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_partners', function(Blueprint $table) {
            if (!Schema::hasColumn('member_partners', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274846_5c8138387a552')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('member_partners', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274846_5c813838a7aa8')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('member_partners', function(Blueprint $table) {
            
        });
    }
}
