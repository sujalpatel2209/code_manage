<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateUserQuestionAnswerTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('user_question_answer', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('writeit_question_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('writeit_question_id')->references('id')->on('writeit_question')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_question_answer');
    }
}
