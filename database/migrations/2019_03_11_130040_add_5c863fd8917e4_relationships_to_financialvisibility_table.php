<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c863fd8917e4RelationshipsToFinancialvisibilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financialvisibilities', function(Blueprint $table) {
            if (!Schema::hasColumn('financialvisibilities', 'id_project_id')) {
                $table->integer('id_project_id')->unsigned()->nullable();
                $table->foreign('id_project_id', '274844_5c81383834234')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('financialvisibilities', function(Blueprint $table) {
            
        });
    }
}
