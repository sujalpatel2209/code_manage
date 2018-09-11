<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
use App\AppConstant\AppConstant;
class CreateTestScoreTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('test_score', function (AppBlueprint $table) {
            $table->increments('id');
            $table->double('score');
            $table->date('date');
            $table->unsignedInteger('test_subject_id');
            $table->foreign('test_subject_id')->references('id')->on('test_subject');
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
        $this->schema->dropIfExists('test_score');
    }
}
