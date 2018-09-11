<?php

use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;
class UsersTestScore extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('users_test_score', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('test_score_id');
            $table->foreign('test_score_id')->references('id')->on('test_score');
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
        $this->schema->dropIfExists('users_test_score');
    }
}
