<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1551972778DeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('deliverables')) {
            Schema::create('deliverables', function (Blueprint $table) {
                $table->increments('id');
                $table->string('label_identification');
                $table->text('title');
                $table->text('short_title');
                $table->date('date')->nullable();
                $table->text('notes');
                $table->integer('confidentiality')->nullable();
                $table->date('submission_date')->nullable();
                $table->integer('due_date_months')->nullable();
                
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
        Schema::dropIfExists('deliverables');
    }
}
