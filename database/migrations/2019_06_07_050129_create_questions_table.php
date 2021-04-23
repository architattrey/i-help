<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('video_id')->nullable();
            $table->string('blog_id')->nullable();
            $table->string('lang_id')->nullable();
            $table->enum('type',[1,2])->nullable();
            $table->text('question')->nullable();
            $table->string('option_one')->nullable();
            $table->string('option_two')->nullable();
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();
            $table->enum('delete_status',[0,1]);
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
        Schema::dropIfExists('questions');
    }
}
