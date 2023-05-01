<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->double('balance')->default(0);
            $table->boolean('is_default')->nullable();
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
        Schema::dropIfExists('balance_accounts');
    }
}
