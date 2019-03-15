<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1551973521RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('risks')) {
            Schema::create('risks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->integer('version')->nullable();
                $table->tinyInteger('flag')->nullable()->default('0');
                $table->tinyInteger('resolved')->nullable()->default('0');
                $table->date('date')->nullable();
                $table->string('title')->nullable();
                $table->text('description');
                $table->text('trigger_events')->nullable();
                $table->integer('score')->nullable();
                $table->text('mitigation');
                $table->text('notes');
                $table->text('contingency');
                $table->time('version_date');
                $table->integer('parent_id')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risks');
    }
}
