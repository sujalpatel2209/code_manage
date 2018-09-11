<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
use App\AppConstant\AppConstant;
class CreateStudentInviteTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('student_invite', function (AppBlueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->string('relation');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile');

            $table->foreign('student_id')->references('id')->on('users');
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
        $this->schema->dropIfExists('student_invite');
    }
}
