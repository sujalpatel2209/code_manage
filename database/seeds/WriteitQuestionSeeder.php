<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WriteitQuestionSeeder extends Seeder
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
                'question' => 'List any clubs you joined, the length of your participation, and the position you held:',
                'description' => 'i.e. President of Modern UN Club; etc.',
                'question_type' => 1
            ],
            [
                'question' => 'What sports if any sports- both in school and outside of school(i.e. AAU, Club soccer, etc.)- have you participated in, the length of your participation, level, and if you were elected as a captain:',
                'description' => null,
                'question_type' => 1
            ],
            [
                'question' => 'Have you been involved in school leadership or governance? (i.e. student body President, Secretary, etc.) If so, please list when you joined, the length of your participation, and the position you held:',
                'description' => null,
                'question_type' => 1
            ],
            [
                'question' => 'List your special awards, honors, recognitions, etc. that you have received in your extracurricular activities.',
                'description' => 'For example, All- League selection, MVP, Community Service award.',
                'question_type' => 2
            ],
            [
                'question' => 'List any volunteer position held, as well as the dates, and the title and responsibility for your role:',
                'description' => null,
                'question_type' => 1
            ],
            [
                'question' => 'Have you had a job either after school or during the summer?',
                'description' => null,
                'question_type' => 1
            ],
            [
                'question' => 'Please list any other family responsibilities or commitments (such as working in a family business or childcare for a younger sibling) that isn\'t already listed above:',
                'description' => null,
                'question_type' => 1
            ],

            [
                'question' => 'Have you participated in any organizations outside of school, such as nonprofits, youth leagues, programs affiliated with religious or cultural group, Boy Scout, Girl Scout, Girls Inc.?',
                'description' => null,
                'question_type' => 1
            ],

            [
                'question' => 'Some student participate in study abroad programs or other programs where they have taught English, helped to build homes, etc -  please list any such programs you participated in:',
                'description' => null,
                'question_type' => 1
            ],

            [
                'question' => 'Many students have hobbies, skills, interests, or things they\'re passionate about that don\'t relate to other clubs or groups. These may include writing music or poetry, studying animated Japanese films, yoga, bird watching, babysitting etc. - really, if there is anything else you spend your time doing, we want to know about it:',
                'description' => null,
                'question_type' => 1
            ],

            [
                'question' => 'What is your dream career? How did you discover your passion and interest for this career?',
                'description' => null,
                'question_type' => 3
            ],
        ];

        foreach ($questions as $question) {
            DB::table('writeit_question')->insert([
                'uuid' => $this->uuid(),
                'question' => $question['question'],
                'description' => $question['description'],
                'question_type' => $question['question_type'],
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today()
            ]);
        }

    }
}
