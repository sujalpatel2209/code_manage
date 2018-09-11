<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
class CreateStudentSchoolNameTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('student_school_name', function (AppBlueprint $table) {
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
        $this->schema->dropIfExists('student_school_name');
    }
}
