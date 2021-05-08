<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('property_name', 20)->nullable()->comment('物件名');
            $table->float('age', 255, 1)->unsigned()->nullable()->comment('築年数');
            $table->text('note', 200)->nullable()->comment('メモ');
            $table->bigInteger('chart_id')->unsigned();
            $table->timestamps();

            $table->foreign('chart_id')->references('id')->on('charts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
