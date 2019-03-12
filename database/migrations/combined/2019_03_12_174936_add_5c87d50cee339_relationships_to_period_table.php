<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c87d50cee339RelationshipsToPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periods', function(Blueprint $table) {
            if (!Schema::hasColumn('periods', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274854_5c81383c7e717')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('periods', function(Blueprint $table) {
            if(Schema::hasColumn('periods', 'project_id')) {
                $table->dropForeign('274854_5c81383c7e717');
                $table->dropIndex('274854_5c81383c7e717');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
