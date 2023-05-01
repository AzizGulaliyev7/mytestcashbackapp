<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackActionAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_action_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashback_action_id');
            $table->string('name');
            $table->enum(
                'condition',
                ['=', '!=', '<', '>', '<=', '>=', 'BETWEEN', 'NOT BETWEEN', 'IN', 'NOT IN', 'LIKE', 'NOT LIKE', 'IS NULL', 'IS NOT NULL']);
            $table->string('value');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashback_action_attributes');
    }
}
