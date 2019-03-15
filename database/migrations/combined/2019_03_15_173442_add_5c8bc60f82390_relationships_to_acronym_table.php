<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8bc60f82390RelationshipsToAcronymTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acronyms', function(Blueprint $table) {
            if (!Schema::hasColumn('acronyms', 'partner_id')) {
                $table->integer('partner_id')->unsigned()->nullable();
                $table->foreign('partner_id', '274823_5c81382f1ded3')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::table('acronyms', function(Blueprint $table) {
            if(Schema::hasColumn('acronyms', 'partner_id')) {
                $table->dropForeign('274823_5c81382f1ded3');
                $table->dropIndex('274823_5c81382f1ded3');
                $table->dropColumn('partner_id');
            }
            
        });
    }
}
