<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552651416RisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            if(Schema::hasColumn('risks', 'risks_type_id')) {
                $table->dropForeign('274866_5c8b87af54a67');
                $table->dropIndex('274866_5c8b87af54a67');
                $table->dropColumn('risks_type_id');
            }
            if(Schema::hasColumn('risks', 'risk_date')) {
                $table->dropColumn('risk_date');
            }
            if(Schema::hasColumn('risks', 'risk_impact_id')) {
                $table->dropForeign('274866_5c8b8d1290760');
                $table->dropIndex('274866_5c8b8d1290760');
                $table->dropColumn('risk_impact_id');
            }
            if(Schema::hasColumn('risks', 'risk_probabilities_id')) {
                $table->dropForeign('274866_5c8b8d12ac7d4');
                $table->dropIndex('274866_5c8b8d12ac7d4');
                $table->dropColumn('risk_probabilities_id');
            }
            if(Schema::hasColumn('risks', 'risk_proximity_id')) {
                $table->dropForeign('274866_5c8b900be48e7');
                $table->dropIndex('274866_5c8b900be48e7');
                $table->dropColumn('risk_proximity_id');
            }
            
        });
Schema::table('risks', function (Blueprint $table) {
            
if (!Schema::hasColumn('risks', 'date')) {
                $table->date('date')->nullable();
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
            $table->dropColumn('date');
            
        });
Schema::table('risks', function (Blueprint $table) {
                        $table->date('risk_date')->nullable();
                
        });

    }
}
