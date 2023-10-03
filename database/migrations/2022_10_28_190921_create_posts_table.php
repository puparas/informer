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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->text('title');
            $table->longText('content');
            $table->tinyInteger('priority')->default('1');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('project_id');
            $table->foreignId('user_id');
            $table->foreignId('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
