<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Collegeyears extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = array(
            'Freshman',
            'Sophomore',
            'Junior',
            'Senior'
        );

        for ($i = 0; $i < count($list); $i++){

            DB::table('college_year')->insert([
                'name' => $list[$i],
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
