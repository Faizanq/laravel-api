<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userdevices', function (Blueprint $table) {
            // $table->increments('id');
             $table->integer('user_id')->nullable();
             $table->string('device_id');
             $table->char('device_type',1);
             $table->string('token_type')->default('Bearer');
             $table->string('access_token');
             $table->boolean('mode')->default(0);//0=>development 1=>production
             $table->boolean('admin_notification')->default(0);//0=>no 1=>yes
            //  $table->string('refresh_token');
			// $table->dateTime('expires_in');
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
        Schema::dropIfExists('userdevices');
    }
}
