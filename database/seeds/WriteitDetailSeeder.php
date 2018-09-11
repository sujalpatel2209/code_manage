<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WriteitDetailSeeder extends Seeder
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
                'question'=>'Why did you participate in this activity?'
            ],

            [
                'question'=>'What was your contribution to this activity? How did you feel about it?'
            ],

            [
                'question'=>'What did you get out of participation in this activity? Special insights, learning, relationships, etc. What was the impact on you and the impact on others?'
            ]
        ];

        foreach ($questions as $question)
        {
            DB::table('writeit_detail_question')->insert([
                'uuid'=> $this->uuid(),
                'question'=>$question['question'],
                'created_at'=>Carbon::today(),
                'updated_at'=>Carbon::today()
            ]);
        }


    }

}
