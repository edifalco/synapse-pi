<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8bd4ade74ffRelationshipsToTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function(Blueprint $table) {
            if (!Schema::hasColumn('teams', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '278114_5c8bc35778840')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('teams', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '278114_5c8bc5e1e20d7')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('teams', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '278114_5c8bc3579f773')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('teams', function(Blueprint $table) {
            if(Schema::hasColumn('teams', 'member_id')) {
                $table->dropForeign('278114_5c8bc35778840');
                $table->dropIndex('278114_5c8bc35778840');
                $table->dropColumn('member_id');
            }
            if(Schema::hasColumn('teams', 'partner_id')) {
                $table->dropForeign('278114_5c8bc5e1e20d7');
                $table->dropIndex('278114_5c8bc5e1e20d7');
                $table->dropColumn('partner_id');
            }
            if(Schema::hasColumn('teams', 'project_id')) {
                $table->dropForeign('278114_5c8bc3579f773');
                $table->dropIndex('278114_5c8bc3579f773');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
