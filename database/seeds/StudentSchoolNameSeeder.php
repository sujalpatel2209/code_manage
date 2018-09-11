<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSchoolNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools= ['Freshman','Sophomore','Junior','Senior'];
        foreach ($schools as $school)
        {
            DB::table('student_school_name')->insert([
                'name'=>$school,
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
