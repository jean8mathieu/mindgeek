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
    public function getIndex($schoolboard_id)
    {
        $students = Student::query()->where('schoolboard_id', $schoolboard_id)->with(['grades'])->get();

        return view('student.index', ['students' => $students]);
    }

    /**
     * This function is used to display the individual student information
     *
     * @param $schoolboard_id
     * @param $student_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function getView($schoolboard_id, $student_id)
    {
        $student = Student::query()
            ->where('schoolboard_id', $schoolboard_id)
            ->where('id', $student_id)
            ->with('grades');

        if ($student->exists()) {
            return view('student.view', ['student' => $student->first()]);
        } else {
            return abort(404);
        }
    }
}
