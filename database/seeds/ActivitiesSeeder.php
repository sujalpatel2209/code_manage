<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = ['Sport','Clubs','Service','Jobs'];
        foreach ($activities as $activity)
        {
            DB::table('activities')->insert([
                'name'=>$activity,
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
