<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b9ca7edb92RelationshipsToMetriciconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metricicons', function(Blueprint $table) {
            if (!Schema::hasColumn('metricicons', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274849_5c81383a96d39')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('metricicons', function(Blueprint $table) {
            if(Schema::hasColumn('metricicons', 'project_id')) {
                $table->dropForeign('274849_5c81383a96d39');
                $table->dropIndex('274849_5c81383a96d39');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
