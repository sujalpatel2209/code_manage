<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['SAT','PSAT','ACT',"Have not take yet"];
        foreach ($subjects as $subject)
        {
            DB::table('test_subject')->insert([
                'name'=>$subject,
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
