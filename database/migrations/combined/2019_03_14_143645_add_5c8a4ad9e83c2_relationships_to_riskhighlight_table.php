<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8a4ad9e83c2RelationshipsToRiskHighlightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risk_highlights', function(Blueprint $table) {
            if (!Schema::hasColumn('risk_highlights', 'risk_id')) {
                $table->integer('risk_id')->unsigned()->nullable();
                $table->foreign('risk_id', '274861_5c81383fb7683')->references('id')->on('risks')->onDelete('cascade');
                }
                if (!Schema::hasColumn('risk_highlights', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274861_5c81383fe0d34')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('risk_highlights', function(Blueprint $table) {
            if(Schema::hasColumn('risk_highlights', 'risk_id')) {
                $table->dropForeign('274861_5c81383fb7683');
                $table->dropIndex('274861_5c81383fb7683');
                $table->dropColumn('risk_id');
            }
            if(Schema::hasColumn('risk_highlights', 'project_id')) {
                $table->dropForeign('274861_5c81383fe0d34');
                $table->dropIndex('274861_5c81383fe0d34');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
