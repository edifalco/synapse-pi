<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c88ef04bdad3RelationshipsToDeliverableMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverable_members', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverable_members', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274834_5c813832b22f7')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverable_members', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274834_5c813832e3cd5')->references('id')->on('deliverables')->onDelete('cascade');
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
        Schema::table('deliverable_members', function(Blueprint $table) {
            if(Schema::hasColumn('deliverable_members', 'member_id')) {
                $table->dropForeign('274834_5c813832b22f7');
                $table->dropIndex('274834_5c813832b22f7');
                $table->dropColumn('member_id');
            }
            if(Schema::hasColumn('deliverable_members', 'deliverable_id')) {
                $table->dropForeign('274834_5c813832e3cd5');
                $table->dropIndex('274834_5c813832e3cd5');
                $table->dropColumn('deliverable_id');
            }
            
        });
    }
}
