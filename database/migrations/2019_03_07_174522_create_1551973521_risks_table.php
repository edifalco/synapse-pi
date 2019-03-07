<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1551973521RisksTable extends Migration
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
                $table->integer('parent_id')->nullable();
                $table->text('description');
                $table->integer('score')->nullable();
                $table->string('flag');
                $table->integer('impact')->nullable();
                $table->integer('probability')->nullable();
                $table->string('proximity');
                $table->text('title');
                $table->text('contingency');
                $table->text('mitigation');
                $table->text('triggerevents');
                $table->integer('resolved')->nullable();
                $table->date('risk_date')->nullable();
                $table->time('version_date');
                $table->integer('type')->nullable();
                $table->text('notes');
                
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
