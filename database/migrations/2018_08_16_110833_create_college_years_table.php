<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateCollegeYearsTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('college_year', function (AppBlueprint $table) {
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
        Schema::dropIfExists('college_year');
    }
}
