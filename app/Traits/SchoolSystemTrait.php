<?php

namespace App\Traits;

use App\Model\Student;
use Spatie\ArrayToXml\ArrayToXml;

trait SchoolSystemTrait
{
    /**
     * This function is used to calculated the average
     *
     * @param $collection
     * @return mixed
     */
    public function calculateTheAverage($collection)
    {
        return $collection->avg();
    }

    /**
     * This function is used to generated the file export that will than be used to send to the external system
     *
     * @param $format
     * @param Student $student
     * @return string
     * @throws \Exception
     */
    public function generateExport($format, Student $student)
    {
        header('Content-disposition: attachment; filename="' . $student->name . '.' . strtolower($format) . '"');
        header('Content-type: text/' . strtolower($format));

        $date = [];

        $data['finalResult'] = ($this->getPassOrFail($format, $student) ? "Pass" : "Fail");

        $data['grades'] = $student->grades()->pluck('grade');
        $data['student']['id'] = $student->id;
        $data['student']['name'] = $student->name;


        switch ($format) {
            case "JSON":
                echo $this->convertToJSON($data);
                break;
            case "XML":
                echo $this->convertToXML($data);
                break;
            default:
                return "Invalid Export Format";
        }
        //To prevent the code from running further
        die();
    }

    /**
     * This function is used to convert an array to XML
     *
     * @param $data
     * @return string
     */
    private function convertToXML($data)
    {
        $array = [];
        $i = 0;

        $student = $data['student'];

        foreach (['id', 'name'] as $value) {
            $array[$value] = $student[$value];
        }

        $array['id'] = $student['id'];
        $array['name'] = $student['name'];

        foreach ($data['grades'] as $d) {
            $i++;
            $array["Grade-{$i}"] = $d;
        }


        return ArrayToXml::convert($array);
    }

    /**
     * This function is use to convert an array to JSON
     *
     * @param $data
     * @return false|string
     */
    private function convertToJSON($data)
    {
        return json_encode($data);
    }

    /**
     * This function is use to determine if the student passed or failed
     *
     * @param $format
     * @param Student $student
     * @return bool|string
     * @throws \Exception
     */
    private function getPassOrFail($format, Student $student)
    {
        switch ($format) {
            case "JSON":
                $avg = $this->calculateTheAverage($student->grades->pluck('grade'));

                //If avg is equal or greater than 7 return true for pass else false for fail
                if ($avg >= 7) {
                    return true;
                }
                return false;
                break;
            case "XML":
                if ($student->grades->count() > 2) {
                    $student->grades()->OrderBy('grade', 'ASC')->first()->delete();
                }

                return true;
                break;
            default:
                return "Invalid Format for school";
        }
    }
}