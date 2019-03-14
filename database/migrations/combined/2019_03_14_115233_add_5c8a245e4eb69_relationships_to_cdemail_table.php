<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a245e4eb69RelationshipsToCdEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_emails', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_emails', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274828_5c813830b821b')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_emails', function(Blueprint $table) {
            if(Schema::hasColumn('cd_emails', 'project_id')) {
                $table->dropForeign('274828_5c813830b821b');
                $table->dropIndex('274828_5c813830b821b');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
