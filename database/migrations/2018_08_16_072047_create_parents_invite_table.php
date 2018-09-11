<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;
class CreateParentsInviteTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('parents_invite', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id');
            $table->string('relation');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');

            $table->foreign('parent_id')->references('id')->on('users');
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
        $this->schema->dropIfExists('parents_invite');
    }
}
