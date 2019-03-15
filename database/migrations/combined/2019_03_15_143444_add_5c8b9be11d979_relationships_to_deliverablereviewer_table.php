<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c8b9be11d979RelationshipsToDeliverableReviewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliverable_reviewers', function(Blueprint $table) {
            if (!Schema::hasColumn('deliverable_reviewers', 'deliverable_id')) {
                $table->integer('deliverable_id')->unsigned()->nullable();
                $table->foreign('deliverable_id', '274836_5c813833d5760')->references('id')->on('deliverables')->onDelete('cascade');
                }
                if (!Schema::hasColumn('deliverable_reviewers', 'member_id')) {
                $table->integer('member_id')->unsigned()->nullable();
                $table->foreign('member_id', '274836_5c8138340f91d')->references('id')->on('members')->onDelete('cascade');
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
        Schema::table('deliverable_reviewers', function(Blueprint $table) {
            if(Schema::hasColumn('deliverable_reviewers', 'deliverable_id')) {
                $table->dropForeign('274836_5c813833d5760');
                $table->dropIndex('274836_5c813833d5760');
                $table->dropColumn('deliverable_id');
            }
            if(Schema::hasColumn('deliverable_reviewers', 'member_id')) {
                $table->dropForeign('274836_5c8138340f91d');
                $table->dropIndex('274836_5c8138340f91d');
                $table->dropColumn('member_id');
            }
            
        });
    }
}
