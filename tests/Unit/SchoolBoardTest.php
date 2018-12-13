<?php

namespace Tests\Unit;

use App\Model\Schoolboard;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolBoardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSchoolBoard()
    {
        //Check that CSM is in the DB
        $this->assertDatabaseHas('schoolboards', [
            'name' => 'CSM'
        ]);

        //Check that CSMB is in the DB
        $this->assertDatabaseHas('schoolboards', [
            'name' => 'CSMB'
        ]);

        //Check that all the Schoolboard are accessible
        foreach(Schoolboard::all() as $schoolboard) {
            $response = $this->get(route('student.index', [
                'schoolboard_id' => $schoolboard->id
            ]));

            $response->assertStatus(200);
        }
    }
}
