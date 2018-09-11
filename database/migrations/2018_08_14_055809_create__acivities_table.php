<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;
class CreateAcivitiesTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('activities', function (AppBlueprint $table) {
            $table->increments('id');
            $table->string('name');
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
        $this->schema->dropIfExists('activities');
    }
}
