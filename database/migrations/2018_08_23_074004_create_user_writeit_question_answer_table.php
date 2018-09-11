<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateUserWriteitQuestionAnswerTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('user_writeit_question_answer', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_que_ans_id');
            $table->unsignedInteger('user_id');
            $table->text('answer')->nullable();
            $table->unsignedInteger('college_year_id')->nullable();
            $table->text('answer2')->nullable();
            $table->foreign('user_que_ans_id')->references('id')->on('user_question_answer')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('college_year_id')->references('id')->on('college_year')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_writeit_question_answer');
    }
}
