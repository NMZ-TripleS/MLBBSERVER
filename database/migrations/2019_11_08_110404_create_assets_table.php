<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("user_id");
            $table->integer("d_count")->default(0);
            $table->integer("t_d_count")->default(0);
            $table->integer("p_count")->default(0);
            $table->integer("t_p_count")->default(0);
            $table->integer("answered_count")->default(0);
            $table->integer("right_answered_count")->default(0);
            $table->integer("four_one_count")->default(0);
            $table->integer("three_one_count")->default(0);
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
        Schema::dropIfExists('assets');
    }
}
