<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Product;
use App\Exports\DataExport;
use App\Candidates;
use DB;
use App\Library\CommonFunction;
use Illuminate\Cookie\CookieJar;
use Cookie;
class CSVController extends Controller
{
   public function importExport()
    {

        return view('mobile.sekilogin');
    }
    public function downloadExcel($type)
    {
      $this->checkSeki();
      try {
        
     
  $data = DB::select("SELECT candidates.id, candidates.firstName as Name,
    sex.name as sex,
email,
mobile,
birth,
graduatesY,
 case candidates.university
when '8000' then candidates.universityName
else universities.name
end as 'University',
majorsTxt as 'Department',
case candidates.currentAdd
                when '264' then candidates.workPlaceTxt
                else addd.Name
            end as 'Address',
            case candidates.birthPlace
                when '264' then candidates.otherBirth
                else add2.Name
            end as 'Birthplace',
jp.name as 'Japanese',
en.name as 'English',
other  as 'Certification',
selfPR AS 'Introduce',
coporations as 'Companies',
workPlace.name as 'working',
  CONCAT('',IFNULL( otherIT,''),IFNULL( otherTech,''),IFNULL( otherLab,''),IFNULL( otherFin,''),occ.col37 ) AS 'Career',
  candidates.fbook AS 'facebook',
   candidates.created_at AS 'Created', 
   candidates.updated_at AS 'Updated'
from candidates 
inner join occupation occ on candidates.code=occ.id
left join master as sex on candidates.sex=sex.id
left join universities on candidates.university=universities.id
left join province2 as addd on  candidates.currentAdd= addd.id
left join province2 as add2 on  candidates.birthPlace= add2.id
left join master as jp on candidates.jLevel=jp.id
left join master as en on candidates.eLevel=en.id
left join master as workPlace on candidates.workPlace=workPlace.id
                            ORDER BY id ASC");
        
        $columTitle = CommonFunction::generateColumnExportCsv();
        $fileName   = 'Candidates';
        $dataExcell       = CommonFunction::generateDataExportCsv($columTitle, $data);
      return  Excel::create($fileName, function($excel) use ($dataExcell) {
            $excel->sheet('detail', function($sheet) use ($dataExcell) {
                $sheet->fromArray($dataExcell);
            });
        })->download($type);
        } catch (Exception $e) {
          dd($e);
        
      }

    }
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });
        }
        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }
    public function sekilogin(CookieJar $cookieJar,Request $request)
    {
       $temptable ='';
       $entry_no= $request->input('entry_no');
       $password= $request->input('password');
       if($entry_no=='SekiSh0'&& $password=='P@Dw0d')
       {
         $cookieJar->queue(cookie('cookieSDFDFA', $entry_no, 600));

       return view('importExport');

       }
         return view('mobile.sekilogin');
     }

           public function checkSeki()
    {
       $cookie1 = Cookie::get('cookieSDFDFA');

        if( is_null($cookie1) ){

         return view('mobile.sekilogin');
        }




    }    
}
