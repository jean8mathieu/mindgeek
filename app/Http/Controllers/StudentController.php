<?php

namespace App\Http\Controllers;

use App\Model\Schoolboard;
use App\Model\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getIndex($schoolboard_id) {

        $schoolboard = Schoolboard::find($schoolboard_id);

        return view('student.index', ['students' => $schoolboard->students]);
    }

    public function getView($schoolboard_id, $student_id) {

        $student = Student::query()
            ->where('schoolboard_id', $schoolboard_id)
            ->where('id', $student_id)
            ->with('grades');

        if($student->exists()){
            return view('student.view', ['student' => $student->first()]);
        } else {
            return abort(404);
        }
    }
}
