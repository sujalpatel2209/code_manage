<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateUserWriteitDetailQuestionAnswerTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('user_detail_question_answer', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_que_ans_id');
            $table->unsignedInteger('detail_question_id');
            $table->text('answer')->nullable();
            $table->foreign('user_que_ans_id')->references('id')->on('user_question_answer')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('detail_question_id')->references('id')->on('writeit_detail_question')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_detail_question_answer');
    }
}
