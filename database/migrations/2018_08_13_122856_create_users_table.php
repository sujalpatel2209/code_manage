<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;

class CreateUsersTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('users', function (AppBlueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('countries_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->nullable();
            $table->foreign('countries_id')->references('id')->on('countries')->nullable();
            $table->integer('zipcode')->nullable();
            $table->enum('user_type',['1','2'])->nullable();
            $table->string('remember_token')->nullable();
            $table->defaultValues();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}
