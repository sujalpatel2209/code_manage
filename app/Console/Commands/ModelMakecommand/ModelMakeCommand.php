<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 14/8/18
 * Time: 10:43 AM
 */

namespace App\Console\Commands\ModelMakecommand;
use Illuminate\Foundation\Console\ModelMakeCommand as Command;

class ModelMakeCommand extends Command
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Entities\Models";
    }
}