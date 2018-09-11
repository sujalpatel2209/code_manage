<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['USA'];
        foreach ($countries as $country)
        {
            DB::table('countries')->insert([
                'name'=>$country,
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
