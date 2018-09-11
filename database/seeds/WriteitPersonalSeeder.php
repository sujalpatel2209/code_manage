<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WriteitPersonalSeeder extends Seeder
{
    use \App\Traits\GetUuid;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'question'=>'Are there any family circumstances in your life that you feel have had an impact on you that has shaped you?'
            ],

            [
                'question'=>'Are there any personal or physical challenges that you\'ve overcome or have had to grapple with? These may include learning differences, physical differences, illness, injuries, etc...'
            ],

            [
                'question'=>'Are there any other experiences, either positive or negative, that has a particularly big impact on you?'
            ],

            [
                'question'=>'Is there anything elese that is important to you that hasn\'t otherwise been covered here?'
            ],

            [
                'question'=>'Outside of your school or work travel, have you experienced meaningful travel to another neighbourhood, state, country, etc.?'
            ],
        ];

        foreach ($questions as $question)
        {
            DB::table('writeit_personal_question')->insert([
                'uuid'=> $this->uuid(),
                'question'=>$question['question'],
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }
    }
}
