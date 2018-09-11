<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
use App\AppConstant\AppConstant;
class CreateStudentProfileTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('student_profile', function (AppBlueprint $table) {
            $table->increments('id');
            $table->double('weight')->nullable();
            $table->double('unweight')->nullable();
            $table->string('about_description')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_year')->nullable();
            $table->string('school_city')->nullable();
            $table->string('graduation_year')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        $this->schema->dropIfExists('student_profile');
    }
}
