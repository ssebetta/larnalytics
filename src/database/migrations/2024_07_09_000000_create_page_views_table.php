<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageViewsTable extends Migration
{
    public function up()
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('page_url');
            $table->timestamp('viewed_at');
            $table->string('ip_address')->nullable();
            $table->string('location')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_views');
    }
}
