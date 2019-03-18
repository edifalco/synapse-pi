<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8f59608e066RelationshipsToProjectMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_members', function(Blueprint $table) {
            if (!Schema::hasColumn('project_members', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274856_5c81383d4c60a')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('project_members', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274856_5c81383d73ffb')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('project_members', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274856_5c81383da0efb')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('project_members', function(Blueprint $table) {
            if(Schema::hasColumn('project_members', 'project_id')) {
                $table->dropForeign('274856_5c81383d4c60a');
                $table->dropIndex('274856_5c81383d4c60a');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('project_members', 'member_id')) {
                $table->dropForeign('274856_5c81383d73ffb');
                $table->dropIndex('274856_5c81383d73ffb');
                $table->dropColumn('member_id');
            }
            if(Schema::hasColumn('project_members', 'partner_id')) {
                $table->dropForeign('274856_5c81383da0efb');
                $table->dropIndex('274856_5c81383da0efb');
                $table->dropColumn('partner_id');
            }
            
        });
    }
}
