<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c867b4b990b2RelationshipsToBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function(Blueprint $table) {
            if (!Schema::hasColumn('budgets', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274826_5c81382fe1395')->references('id')->on('partners')->onDelete('cascade');
                }
                if (!Schema::hasColumn('budgets', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274826_5c81383015784')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('budgets', function(Blueprint $table) {
            if(Schema::hasColumn('budgets', 'partner_id')) {
                $table->dropForeign('274826_5c81382fe1395');
                $table->dropIndex('274826_5c81382fe1395');
                $table->dropColumn('partner_id');
            }
            if(Schema::hasColumn('budgets', 'project_id')) {
                $table->dropForeign('274826_5c81383015784');
                $table->dropIndex('274826_5c81383015784');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
