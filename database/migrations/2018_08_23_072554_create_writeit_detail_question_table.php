<?php

use Illuminate\Support\Facades\Schema;
use App\MigrationBluePrint\AppBlueprint;
use App\MigrationBluePrint\AppMigration;

class CreateWriteitDetailQuestionTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('writeit_detail_question', function (AppBlueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();
            $table->text('question');
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
        $this->schema->dropIfExists('writeit_detail_question');
    }
}
