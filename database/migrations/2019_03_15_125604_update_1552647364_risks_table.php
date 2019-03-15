<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552647364RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'flag')) {
                $table->dropColumn('flag');
            }
            if(Schema::hasColumn('risks', 'resolved')) {
                $table->dropColumn('resolved');
            }
            
        });
Schema::table('risks', function (Blueprint $table) {
            
if (!Schema::hasColumn('risks', 'flag')) {
                $table->tinyInteger('flag')->nullable()->default('0');
                }
if (!Schema::hasColumn('risks', 'resolved')) {
                $table->tinyInteger('resolved')->nullable()->default('0');
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
            $table->dropColumn('flag');
            $table->dropColumn('resolved');
            
        });
Schema::table('risks', function (Blueprint $table) {
                        $table->string('flag');
                $table->integer('resolved')->nullable();
                
        });

    }
}
