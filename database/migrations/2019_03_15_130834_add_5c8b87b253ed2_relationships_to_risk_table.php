<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b87b253ed2RelationshipsToRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function(Blueprint $table) {
            if (!Schema::hasColumn('risks', 'risks_type_id')) {
                $table->integer('risks_type_id')->unsigned()->nullable();
                $table->foreign('risks_type_id', '274866_5c8b87af54a67')->references('id')->on('risk_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risks', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274866_5c813842a9f84')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('risks', function(Blueprint $table) {
            
        });
    }
}
