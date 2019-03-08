<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c82a0d13760bRelationshipsToCdDisseminationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cd_disseminations', function(Blueprint $table) {
            if (!Schema::hasColumn('cd_disseminations', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274827_5c8138307a059')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('cd_disseminations', function(Blueprint $table) {
            if(Schema::hasColumn('cd_disseminations', 'project_id')) {
                $table->dropForeign('274827_5c8138307a059');
                $table->dropIndex('274827_5c8138307a059');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
