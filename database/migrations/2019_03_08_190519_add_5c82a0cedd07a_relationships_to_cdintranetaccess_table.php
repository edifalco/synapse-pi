<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c82a0cedd07aRelationshipsToCdIntranetAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_intranet_accesses', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_intranet_accesses', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274829_5c81383109333')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_intranet_accesses', function(Blueprint $table) {
            
        });
    }
}
