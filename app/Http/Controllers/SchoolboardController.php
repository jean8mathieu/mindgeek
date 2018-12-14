<?php

namespace App\Http\Controllers;

use App\Model\Schoolboard;
use App\Model\Student;
use App\Traits\SchoolSystemTrait;
use Illuminate\Http\Request;

class SchoolboardController extends Controller
{
    use SchoolSystemTrait;

    /**
     * This function is used to display the table of the schoolboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        return view('schoolboard', ['schoolboards' => Schoolboard::all()]);
    }

    /**
     * This function will initiate the student data export
     *
     * @param $schoolboard_id
     * @param $student_id
     * @throws \Exception
     */
    public function exportStudentInfo(Schoolboard $schoolboard, Student $student)
    {
        //Student not found
        if (!$student) {
            return abort(404);
        }

        $this->generateExport($schoolboard->formatType, $student);

    }

}
