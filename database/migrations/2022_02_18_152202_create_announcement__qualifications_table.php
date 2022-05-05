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
        Schema::create('announcement_qualification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_id')->nullable();
            $table->foreign('announcement_id')->references('id')->on('announcements')->cascadeOnDelete();
            $table->unsignedBigInteger('qualification_id')->nullable();
            $table->foreign('qualification_id')->references('id')->on('qualifications')->cascadeOnDelete();
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
        Schema::dropIfExists('announcement__qualifications');
    }
};
