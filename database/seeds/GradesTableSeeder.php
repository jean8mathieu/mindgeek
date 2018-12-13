<?php

use Illuminate\Database\Seeder;
use \App\Model\Student;
Use \Carbon\Carbon;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Student::all() as $student) {
            $amountOfGrades = rand(1, 4);

            for ($i = 0; $i < $amountOfGrades; $i++) {
                DB::table('grades')->insert([
                    'student_id' => $student->id,
                    'grade' => rand(0, 10),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
