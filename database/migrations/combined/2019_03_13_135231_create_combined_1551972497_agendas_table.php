<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1551972497AgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('agendas')) {
            Schema::create('agendas', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->string('hour');
                $table->string('minute');
                $table->string('title');
                $table->text('description');
                $table->string('category');
                $table->string('duration');
                $table->string('meeting_type');
                $table->string('date_creation');
                
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
        Schema::dropIfExists('agendas');
    }
}
