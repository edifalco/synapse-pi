<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552653215RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'title')) {
                $table->dropColumn('title');
            }
            
        });
Schema::table('risks', function (Blueprint $table) {
            
if (!Schema::hasColumn('risks', 'title')) {
                $table->string('title')->nullable();
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
        Schema::table('risks', function (Blueprint $table) {
            $table->dropColumn('title');
            
        });
Schema::table('risks', function (Blueprint $table) {
                        $table->text('title');
                
        });

    }
}
