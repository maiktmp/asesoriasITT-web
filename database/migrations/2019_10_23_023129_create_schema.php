<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('carrier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('username');
            $table->string('password');
            $table->timestamps();

            $table->unsignedInteger('fk_id_rol');
            $table->unsignedInteger('fk_id_carrier');

            $table->foreign('fk_id_rol')
                ->references('id')
                ->on('rol');

            $table->foreign('fk_id_carrier')
                ->references('id')
                ->on('carrier');
        });

        Schema::create('advisory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('place_name')->nullable();
            $table->unsignedInteger('fk_id_user');

            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');
        });

        Schema::create('day', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('advisory_has_day', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start_hour');
            $table->time('end_hour');

            $table->unsignedInteger('fk_id_advisory');
            $table->unsignedInteger('fk_id_day');

            $table->foreign('fk_id_day')
                ->references('id')
                ->on('day');

            $table->foreign('fk_id_advisory')
                ->references('id')
                ->on('advisory');
        });

        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');

            $table->unsignedInteger('fk_id_advisory_has_day');

            $table->foreign('fk_id_advisory_has_day')
                ->references('id')
                ->on('advisory_has_day');
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');

            $table->unsignedInteger('fk_id_user');

            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("contact");
        Schema::dropIfExists("notification");
        Schema::dropIfExists("advisory_has_day");
        Schema::dropIfExists("day");
        Schema::dropIfExists("advisory");
        Schema::dropIfExists("user");
        Schema::dropIfExists("carrier");
        Schema::dropIfExists("rol");
    }
}
