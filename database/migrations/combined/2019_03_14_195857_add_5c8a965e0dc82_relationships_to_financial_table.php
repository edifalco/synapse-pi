<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a965e0dc82RelationshipsToFinancialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials', function(Blueprint $table) {
            if (!Schema::hasColumn('financials', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274843_5c813837e92f6')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('financials', function(Blueprint $table) {
            if(Schema::hasColumn('financials', 'project_id')) {
                $table->dropForeign('274843_5c813837e92f6');
                $table->dropIndex('274843_5c813837e92f6');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
