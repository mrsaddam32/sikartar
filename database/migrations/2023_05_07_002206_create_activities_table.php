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
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_id', 8)->unique();
            $table->string('activity_name');
            $table->string('responsible_person');
            $table->string('activity_description');
            $table->integer('activity_budget');
            $table->enum('activity_status', ['PENDING', 'REJECTED', 'APPROVED', 'COMPLETED']);
            $table->string('activity_location');
            $table->date('activity_start_date');
            $table->date('activity_end_date');
            $table->string('document_name')->nullable();
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
        Schema::dropIfExists('activities');
    }
};
