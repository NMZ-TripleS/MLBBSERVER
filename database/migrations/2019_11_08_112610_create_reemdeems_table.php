<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReemdeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reemdeems', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("user_id");
            $table->integer("reemdeemed_amount")->default(0);
            $table->timestamps();
            $table->boolean("is_valid_amount")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reemdeems');
    }
}
