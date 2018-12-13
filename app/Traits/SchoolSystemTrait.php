<?php

namespace App\Traits;

use App\Model\Student;
use Illuminate\Support\Facades\Log;
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
        //Round up if the average is decimal
        return ceil($collection->avg());
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

        //Check if the student pass or fail
        $data['finalResult'] = ($this->getPassOrFail($format, $student) ? "Pass" : "Fail");

        //Get the student grades
        $grades = $student->grades()->pluck('grade');

        //Get the student average
        $data['average'] = $this->calculateTheAverage($grades);

        //Assigning the student data that will be used to generate the JSON or XML
        $data['grades'] = $grades;
        $data['student']['id'] = $student->id;
        $data['student']['name'] = $student->name;

        //Generate the data and echo it on the page
        switch ($format) {
            case "JSON":
                try {
                    echo $this->convertToJSON($data);
                } catch (\Exception $e) {
                    Log::error("There was an issue converting the data to a JSON format");
                }
                break;
            case "XML":
                try {
                    echo $this->convertToXML($data);
                } catch (\Exception $e) {
                    Log::error("There was an issue converting the data to a XML format");
                }
                break;
            default:
                Log::error("Invalid Format");
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

        foreach (['finalResult', 'average'] as $value) {
            $array[$value] = $data[$value];
        }

        foreach ($data['grades'] as $d) {
            $i++;
            $array["grade-{$i}"] = $d;
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
                //If student have more than 2 grades delete the lowest one
                if ($student->grades->count() > 2) {
                    try {
                        $student->grades()->OrderBy('grade', 'ASC')->first()->delete();
                    } catch (\Exception $e) {
                        Log::error("There was an issue while deleting the lowest grade");
                    }
                }

                return true;
                break;
            default:
                Log::error("Invalid Format for school");
        }
        return false;
    }
}