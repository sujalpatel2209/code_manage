<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateWriteitQuestionTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('writeit_question', function (AppBlueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();
            $table->text('question');
            $table->text('description')->nullable();
            $table->tinyInteger('question_type')->comment('1 = DurationalAnswer, 2 = ListAnswer, 3 = DetailAnswer');
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
        Schema::dropIfExists('writeit_question');
    }
}
