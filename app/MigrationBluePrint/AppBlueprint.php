<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 13/8/18
 * Time: 5:38 PM
 */

namespace App\MigrationBluePrint;

use App\AppConstant\AppConstant;
use Illuminate\Database\Schema\Blueprint;

class AppBlueprint extends Blueprint
{

    public function defaultValues()
    {
        $this->tinyInteger('status')->default(AppConstant::STATUS_ACTIVE);
        $this->timestamps();

    }

    public function generateUuid()
    {
        $this->uuid('id');
        $this->primary('id');
    }
}