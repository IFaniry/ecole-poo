<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('employeeId')->references('id')->on('employees');
            $table->float('dailyVolumeInHours', 2, 2)->nullable();
            $table->timestamp('checkIn');
            $table->timestamp('checkOut')->nullable();
            $table->timestamp('comment')->nullable();

            $table->index('checkIn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timers');
    }
}
