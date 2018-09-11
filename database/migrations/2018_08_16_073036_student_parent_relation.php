<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
class StudentParentRelation extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            $this->schema->create('student_parent_relation', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('parent_id');
            $table->string('relation');
            $table->foreign('student_id')->references('id')->on('users');
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
        $this->schema->dropIfExists('student_parent_relation');
    }
}
