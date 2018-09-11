<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 13/8/18
 * Time: 5:38 PM
 */

namespace App\MigrationBluePrint;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\MigrationBluePrint\AppBlueprint;
class AppMigration extends Migration
{
    protected $schema;

    public function __construct()
    {
        $this->schema = DB::connection()->getSchemaBuilder();
        $this->schema->blueprintResolver(function ($table, $callback) {
            return new AppBluePrint($table, $callback);
        });
    }

}