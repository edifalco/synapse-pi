<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8629158dc34RelationshipsToMemberroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('memberroles', function(Blueprint $table) {
            if (!Schema::hasColumn('memberroles', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274847_5c81383933985')->references('id')->on('members')->onDelete('cascade');
                }
                if (!Schema::hasColumn('memberroles', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274847_5c8138396c707')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('memberroles', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274847_5c813839a0b05')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('memberroles', function(Blueprint $table) {
            
        });
    }
}
