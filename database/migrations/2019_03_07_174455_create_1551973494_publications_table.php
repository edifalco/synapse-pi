<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1551973494PublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('publications')) {
            Schema::create('publications', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('year');
                $table->integer('month')->nullable();
                $table->string('abbr');
                $table->string('link');
                $table->string('authors');
                
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
        Schema::dropIfExists('publications');
    }
}
