<?php

namespace App\Http\Controllers;

use App\Model\Schoolboard;
use App\Model\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * This function is used to display the student of the specific school board
     *
     * @param $schoolboard_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Schoolboard $schoolboard)
    {
        $students = Student::query()->where('schoolboard_id', $schoolboard->id)->with(['grades'])->get();

        //If schoolboard isn't valid return 404
        if (!$students) {
            return abort(404);
        }

        return view('student.index', ['students' => $students]);
    }

    /**
     * This function is used to display the individual student information
     *
     * @param $student_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getView(Schoolboard $schoolboard, Student $student)
    {
        //Make sure the student is from this schoolboard
        if ($schoolboard->id === $student->schoolboard_id) {
            return view('student.view', ['student' => $student]);
        } else {
            return abort(404);
        }
    }
}
