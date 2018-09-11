<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MigrationBluePrint\AppMigration;
use App\MigrationBluePrint\AppBlueprint;
use App\AppConstant\AppConstant;
class CreateContactMethodTable extends AppMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('contact_method', function (AppBlueprint $table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('skype_id')->nullable();
            $table->string('other')->nullable();
            $table->string('contact_by')->nullable();
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
        $this->schema->dropIfExists('contact_method');
    }
}
