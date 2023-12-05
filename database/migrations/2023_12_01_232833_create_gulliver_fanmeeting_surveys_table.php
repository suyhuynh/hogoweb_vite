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
        Schema::create('customer_gulliver_fanmeeting_surveys', function (Blueprint $table) {
            $table->id();
            $table->char('code')->unique();
            $table->char('type')->nullable();
            $table->char('fullname')->nullable();
            $table->char('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('email')->nullable();
            $table->char('status')->default('active')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->string('short_name')->nullable();
            $table->text('extend')->nullable();
            $table->index(['id']);
            $table->timestamps();
        });

        Schema::create('customer_gulliver_fanmeeting_survey_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->integer('question_id')->nullable();
            $table->text('answers')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')
            ->on('customer_gulliver_fanmeeting_survey_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_gulliver_fanmeeting_surveys');
        Schema::dropIfExists('customer_gulliver_fanmeeting_survey_answers');
    }
};
