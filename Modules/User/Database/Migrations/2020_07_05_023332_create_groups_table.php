<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('type')->nullable();
            $table->boolean('is_layout');
            $table->integer('header_id')->nullable()->default(0);
            $table->integer('footer_id')->nullable()->default(0);
            $table->char('author')->nullable();
            $table->unsignedInteger('order')->nullable()->default(1);
            $table->tinyInteger('status')->default(1)->nullable();
            $table->integer('created_by')->nullable();
            $table->datetime('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('group_translates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->char('lang_code')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('alias')->nullable();
            $table->string('img')->nullable();
            $table->text('galleries')->nullable();
            $table->dateTime('created_at');
            $table->index(['id', 'group_id']);
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
