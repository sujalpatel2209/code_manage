<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ExamSubjectSeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(StudentSchoolNameSeeder::class);
        $this->call(WriteitDetailSeeder::class);
        $this->call(WriteitPersonalSeeder::class);
        $this->call(WriteitQuestionSeeder::class);
        $this->call(Collegeyears::class);
    }
}
