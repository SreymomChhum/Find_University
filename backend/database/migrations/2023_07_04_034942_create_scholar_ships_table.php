<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scholar_ships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('media_id')->nullable();
            $table->integer("user_number")->nullable();
            $table->boolean("full")->default(0);
            $table->string('description')->nullable();
            $table->date('post_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->unsignedBigInteger('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->unsignedBigInteger('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholar_ships');
    }
};
