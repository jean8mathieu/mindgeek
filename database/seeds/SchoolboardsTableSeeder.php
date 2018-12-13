<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class SchoolboardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Inserting the Schoolboards into the table
        foreach(['CSM' => ['format' => 'JSON'], 'CSMB' => ['format' => 'XML']] as $key => $schoolboard) {
            DB::table('schoolboards')->insert([
                'name' => $key,
                'formatType' => $schoolboard['format'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
