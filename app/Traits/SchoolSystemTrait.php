<?php

namespace App\Traits;

use App\Model\Student;
use Spatie\ArrayToXml\ArrayToXml;

trait SchoolSystemTrait{
    public function calculateTheAverage($collection){
        return $collection->avg();
    }

    public function generateExport($format, Student $student){
        header('Content-type: text/' . strtolower($format));

        $date = [];

        $data['finalResult'] = ($this->getPassOrFail($format, $student) ? "Pass" : "Fail");

        $data['grades'] = $student->grades()->pluck('grade');
        $data['student']['id'] = $student->id;
        $data['student']['name'] = $student->name;


        switch($format){
            case "JSON":
                echo $this->convertToJSON($data);
                break;
            case "XML":
                echo $this->convertToXML($data);
                break;
            default:
                return "Invalid Export Format";
        }
    }

    private function convertToXML($data) {
        $array = [];
        $i = 0;

        $student = $data['student'];

        foreach(['id', 'name'] as $value) {
            $array[$value] = $student[$value];
        }

        $array['id'] = $student['id'];
        $array['name'] = $student['name'];

        foreach($data['grades'] as $d) {
            $i++;
            $array["Grade-{$i}"] = $d;
        }


        return ArrayToXml::convert($array);
    }

    private function convertToJSON($data) {
        return json_encode($data);
    }

    private function getPassOrFail($format, Student $student){
        switch($format) {
            case "JSON":
                $avg = $this->calculateTheAverage($student->grades->pluck('grade'));

                //If avg is equal or greater than 7 return true for pass else false for fail
                if($avg >= 7) {
                    return true;
                }
                return false;
                break;
            case "XML":
                if($student->grades->count() > 2) {
                    $student->grades()->OrderBy('grade', 'ASC')->first()->delete();
                }

                return true;
                break;
            default:
                return "Invalid Format for school";
        }
    }
}