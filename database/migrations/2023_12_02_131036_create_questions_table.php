<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->integer('order')->default(1);
            $table->char('type')->nullable();
            $table->char('form_name')->default('checkbox')->nullable();
            $table->bigInteger('created_by')->default(0);
            $table->char('status')->nullable()->default('publish');
            $table->timestamps();
        });

        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->string('name');
            $table->char('form_name')->nullable();
            $table->bigInteger('vote')->default(0)->nullable();
            $table->bigInteger('position')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('question_id')->references('id')
                ->on('questions')->onDelete('cascade');
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
        Schema::dropIfExists('question_answers');
    }
};
