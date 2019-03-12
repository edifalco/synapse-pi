<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c867b5c3e0cbRelationshipsToFaqQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faq_questions', function(Blueprint $table) {
            if (!Schema::hasColumn('faq_questions', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '275200_5c8250a96e24f')->references('id')->on('faq_categories')->onDelete('cascade');
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
        Schema::table('faq_questions', function(Blueprint $table) {
            if(Schema::hasColumn('faq_questions', 'category_id')) {
                $table->dropForeign('275200_5c8250a96e24f');
                $table->dropIndex('275200_5c8250a96e24f');
                $table->dropColumn('category_id');
            }
            
        });
    }
}
