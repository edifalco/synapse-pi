<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8280ebbfcc9RelationshipsToDocumentFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_favorites', function(Blueprint $table) {
            if (!Schema::hasColumn('document_favorites', 'document_id')) {
                $table->integer('document_id')->unsigned()->nullable();
                $table->foreign('document_id', '274840_5c813835b9b8a')->references('id')->on('documents')->onDelete('cascade');
                }
                if (!Schema::hasColumn('document_favorites', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '274840_5c813835ef184')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::table('document_favorites', function(Blueprint $table) {
            if(Schema::hasColumn('document_favorites', 'document_id')) {
                $table->dropForeign('274840_5c813835b9b8a');
                $table->dropIndex('274840_5c813835b9b8a');
                $table->dropColumn('document_id');
            }
            if(Schema::hasColumn('document_favorites', 'project_id')) {
                $table->dropForeign('274840_5c813835ef184');
                $table->dropIndex('274840_5c813835ef184');
                $table->dropColumn('project_id');
            }
            
        });
    }
}
