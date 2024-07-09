<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomEventsTable extends Migration
{
    public function up()
    {
        Schema::create('larnalytics_custom_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->json('event_data')->nullable();
            $table->timestamp('occurred_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('larnalytics_custom_events');
    }
}

