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
        Schema::create('ticket__times', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->unsignedInteger('type');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ticket_id');
            $table->timestamps();
        });

        Schema::table('ticket__times', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('ticket__times', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('ticket__tickets');
        });

        Schema::table('ticket__times', function (Blueprint $table) {
            $table->foreign('type')->references('id')->on('ticket__tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket__times');
    }
};
