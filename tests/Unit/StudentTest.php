<?php

namespace Tests\Unit;

use App\Model\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStudentPageLoad()
    {
        foreach(Student::all() as $student) {
            $response = $this->get(route('student.view', [
                'schoolboard_id' => $student->schoolboard_id,
                'student_id' => $student->id
            ]));

            $response->assertStatus(200);
        }
    }
}
