<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_id = 1;
        $states= ['Illinois','Texas','Virginia','Florida'];
        foreach ($states as $state)
        {
            DB::table('states')->insert([
                'name'=>$state,
                'countries_id'=>$countries_id,
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
