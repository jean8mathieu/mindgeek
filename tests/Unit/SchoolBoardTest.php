<?php

namespace Tests\Unit;

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
        $this->assertDatabaseHas('schoolboards', [
            'name' => 'CSM'
        ]);

        $this->assertDatabaseHas('schoolboards', [
            'name' => 'CSMB'
        ]);


        $this->assertTrue(true);
    }
}
