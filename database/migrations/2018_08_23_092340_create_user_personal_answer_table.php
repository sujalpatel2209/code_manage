<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateUserPersonalAnswerTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('user_personal_answer', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('personal_question_id');
            $table->text('answer')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('personal_question_id')->references('id')->on('writeit_personal_question')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('user_personal_answer');
    }
}
