<?php

namespace App\Library;

use Illuminate\Http\Request;
use DateTime;
use Lang;
use Carbon\Carbon;
use DB;
use App\Library\CacheHelper;

class CommonFunction
{
    const STATUS_PASSWORD_NOT_CORRECT = 401;
    const STATUS_VALIDATE_ERROR = 422;
    const STATUS_FINISH_WORKED = 409;
    /*
     * key cache
     */
    const KEY_CACHE = 'load-data';

    public static function autoIncrement($lenght)
    {
        for ($i = 0; $i < $lenght; $i ++) {
            yield $i;
        }
    }

    /**
     * load data
     * @return array
     */
    

    /**
     * validate integer
     * @param string
     * @return boolean
     */
    public static function validateNumber($arrayValue, $integer = null)
    {
       
        return true;
    }

    /**
     * validate string
     * @param string
     * @param int
     * @return boolean
     */
    public static function validateString($value, $lenghtMax)
    {
        $value = trim($value);
        $lenghtValue = strlen($value);
        if ($lenghtValue > $lenghtMax || $lenghtValue == 0) {
            return false;
        }
        return true;
    }

    /**
     * validate date
     * @param string
     * @return boolean
     */
    public static function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    /**
     * validate hour
     * @param string
     * @return boolean
     */
    public static function validateHour($hour)
    {
        $h = DateTime::createFromFormat('H:i', $hour);
        return $h && $h->format('H:i') === $hour;
    }


    /**
     * validate time journey
     * @param string
     * @return boolean
     */
    public static function validateTimeJourney($hour)
    {
        $fullTime = DateTime::createFromFormat('Y-m-d H:i:s', $hour);
        $h = DateTime::createFromFormat('Y-m-d H:i', $hour);
        if (($fullTime && $fullTime->format('Y-m-d H:i:s') === $hour) ||
            ($h && $h->format('Y-m-d H:i') === $hour)
        ) {
            return true;
        }
        return false;
    }

    /**
     * validate time
     * @param string
     * @return boolean
     */
    public static function validateTime($startHour, $finishHour)
    {
        if (strtotime($finishHour) < strtotime($startHour)) {
            return false;
        }
        return true;
    }

    /**
     * check isset value
     * @param array
     * @param array
     * @return boolean
     */
    public static function checkIsset($data, $arrayField)
    {
        foreach ($arrayField as $value) {
            if (!isset($data[$value])) {
                return true;
            }
        }
        return false;
    }
            public static function getArraycodes ($arrayData)
    {
        $array = array();
        foreach ($arrayData as $arrayData) {
           array_push($array,$arrayData['id']);
        }
        return $array;
    }

    /**
     * get data export csv
     * @param array
     * @return array
     */


    /**
     * generate column export Csv
     * @return array
     */


    /**
     * generate data for export csv
     * @param  array $columns
     * @param  array $journeys
     * @return array
     */
   

    /**
     * check data download csv
     * @param  array $data
     * @return array
     */


    /**
     * clear all cache
     */

    /**
     * clear cache item
     * @param  string $key
     */

    /**
     * generate file name download csv
     * @param  array $data
     * @return string
     */


    /**
     * random string
     * @param int
     * @return string
     */
    public static function randomString($length) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
    public static function getAutoInscrement($table)
    {
              $statement = DB::select("SHOW TABLE STATUS LIKE '".$table."'");
      $maxnum = $statement[0]->Auto_increment;
      return  $maxnum;
    }
     public static function generateColumnExportCsv()
    {
        return array(
    'No'                         => Lang::get('download-csv.Candidate_STT'),
    'name'                       => Lang::get('download-csv.Candidate_Name'),
    'sex'                        => Lang::get('download-csv.Candidate_Sex'),
    'Email'                      => Lang::get('download-csv.Candidate_Email'),
    'Mobile'                     => Lang::get('download-csv.Candidate_Mobile'),
    'Birthday'                   => Lang::get('download-csv.Candidate_Birthday'),
    'GraduateYear'               => Lang::get('download-csv.Candidate_GraduateYear'),
    'University'                 => Lang::get('download-csv.Candidate_University'),
    'Department'                 => Lang::get('download-csv.Candidate_Department'),
    'Address'                    => Lang::get('download-csv.Candidate_Address'),
    'Birthplace'                 => Lang::get('download-csv.Candidate_Birthplace'),
    'Japanese'                   => Lang::get('download-csv.Candidate_Japanese'),
    'English'                    => Lang::get('download-csv.Candidate_English'),
    'Certification'              => Lang::get('download-csv.Candidate_Certification'),
    'SelfPR'                     => Lang::get('download-csv.Candidate_SelfPR'),
    'Compamies'                  => Lang::get('download-csv.Candidate_Compamies'),
    'Workpl'                     => Lang::get('download-csv.Candidate_Workpl'),
    'Occ'                        => Lang::get('download-csv.Candidate_Occ'   ),
    'facebook'                   => Lang::get('download-csv.Candidate_facebook'),
    'Created'                    => Lang::get('download-csv.Candidate_Created'),
    'Updated'                    => Lang::get('download-csv.Candidate_Updated'),
         
        );
    }
     public static function generateDataExportCsv($columns, $arrDatas)
    {
        $row_order = 0;
        $data = [];
        if ($arrDatas) {
            foreach ($arrDatas as $key => $arrData) {
               $row_order++;
               $row = [];
               $row[$columns['No']]         = $row_order;
               $row[$columns['name']]=$arrData->Name                  ;
               $row[$columns['sex']]=$arrData->sex                    ;
               $row[$columns['Email']]=$arrData->email                ;
               $row[$columns['Mobile']]=$arrData->mobile              ;
               $row[$columns['Birthday']]=$arrData->birth             ;
               $row[$columns['GraduateYear']]=$arrData->graduatesY    ;
               $row[$columns['University']]=$arrData->University      ;
               $row[$columns['Department']]=$arrData->Department      ;
               $row[$columns['Address']]=$arrData->Address            ;
               $row[$columns['Birthplace']]=$arrData->Birthplace      ;
               $row[$columns['Japanese']]=$arrData->Japanese          ;
               $row[$columns['English']]=$arrData->English            ;
               $row[$columns['Certification']]=$arrData->Certification;
               $row[$columns['SelfPR']]=$arrData->Introduce           ;
               $row[$columns['Compamies']]=$arrData->Companies        ;
               $row[$columns['Workpl']]=$arrData->working             ;
               $row[$columns['Occ']]=$arrData->Career                 ;
               $row[$columns['facebook']]=$arrData->facebook          ;
               $row[$columns['Created']]=$arrData->Created            ;
               $row[$columns['Updated']]=$arrData->Updated            ;


              
        

               
                $data[]                         = $row;
            }
        } else {
            foreach ($columns as $key => $value) {
                $row[$columns[$key]] = null;
            }
            $data[] = $row;
        }
        return $data;
    }
}
