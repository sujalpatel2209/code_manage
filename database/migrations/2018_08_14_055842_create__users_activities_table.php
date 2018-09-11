<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;
class CreateUsersActivitiesTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('users_activities', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('activities_id');
            $table->foreign('activities_id')->references('id')->on('activities');
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
        $this->schema->dropIfExists('users_activities');
    }
}
