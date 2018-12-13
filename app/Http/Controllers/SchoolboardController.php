<?php

namespace App\Http\Controllers;

use App\Model\Schoolboard;
use App\Model\Student;
use App\Traits\SchoolSystemTrait;
use Illuminate\Http\Request;

class SchoolboardController extends Controller
{
    use SchoolSystemTrait;
    public function getIndex(){
        return view('schoolboard', ['schoolboards' => Schoolboard::all()]);
    }

    public function exportStudentInfo($student_id){
        $student = Student::find($student_id);

        //Student not found
        if(!$student){
            return abort(404);
        }

        $avg = $this->calculateTheAverage($student->grades->pluck('grade'));


    }

    public function test(){
        $student = Student::find(9);
        $this->generateExport("XML", $student);
    }

}
