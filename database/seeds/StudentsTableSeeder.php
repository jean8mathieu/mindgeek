<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \Carbon\Carbon;
use \App\Model\Schoolboard;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generate a fake list of students for the various School boards
        for ($i = 0; $i < 100; $i++) {
            DB::table('students')->insert([
                'name' => Factory::create()->name,
                'schoolboard_id' => Schoolboard::inRandomOrder()->first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
