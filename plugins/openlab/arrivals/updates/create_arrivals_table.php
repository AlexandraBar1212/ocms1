<?php namespace Openlab\Arrivals\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateArrivalsTable extends Migration
{
    public function up()
    {
        Schema::create('openlab_arrivals_arrivals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->integer('user_id')->nullable()->index();
            $table->timestamp('arrival')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('openlab_arrivals_arrivals');
    }
}