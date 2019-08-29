<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master;
use App\Master2;
use App\Occupation;
use App\Division;
use App\Province2;
use App\Universities;
use App\User;
use App\Units;
use App\Items;
use App\Coporations_2018_11;
use App\Candidates_2018_05;
use App\Candidates;
use App\Coporations_2018_05;
use App\Library\CommonFunction;
use DB;
use Mail;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Cookie\CookieJar;
use Cookie;
class JobfairController extends Controller
{
   public function index()
        {
        
       $temptable ='';
    $useragent=$_SERVER['HTTP_USER_AGENT'];

if($this->fcMobileCheck($useragent))
      {
       return view('job.mobile', compact('temptable'));

      } 
      return view('job.jobfairWeb', compact('temptable'));
    }

    public function company()
       {
          $coporations =Coporations_2018_11::orderBy('sort','asc')->get();
       $temptable ='';
        // $this->checkSeki();
    $useragent=$_SERVER['HTTP_USER_AGENT'];
if($this->fcMobileCheck($useragent))
      {
       return view('mobile.commobile', compact('temptable','coporations'));
      } 
      return view('mobile.copanies', compact('temptable','coporations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            

       
            $entry_no=Candidates::count();

            $entry_no=$entry_no+1;
            $coporations =Coporations_2018_11::orderBy('sort','ASC')->get();
             $master=DB::table('master') ->orderBy('sort', 'ASC')->get();
            $workplace = $master;
            $english_levels=$master;
            $japanese_levels=$master;
            $province=Province2::orderBy('Name', 'ASC') ->get();
            $work_places=$master;
            $birth_places=$province;
            $addresses=$province;
            $universities=DB::table('universities') ->orderBy('id', 'ASC')->get();
            $items=Items::all();
            $subitemsIT =    $items;
            $subitemsTech =  $items;
            $subitemsLab =   $items;
            $subitemsFin =   $items;
            $subitemsOther = $items;
            $birth_place=$other_birthplace=$address=$other_address=$university=
            $other_university='' ;

                $useragent=$_SERVER['HTTP_USER_AGENT'];
if($this->fcMobileCheck($useragent))
      {
       return view('mobile.job', compact('coporations','workplace','work_places','birth_places','subitemsIT','subitemsTech','subitemsLab'
              ,'subitemsFin','subitemsOther','entry_no','universities'
             , 'birth_place','other_birthplace','addresses','address','other_address'
             ,'university','other_university','english_levels','japanese_levels'));

      } 
  
      return view('job.job', compact('coporations','workplace','work_places','birth_places','subitemsIT','subitemsTech','subitemsLab'
              ,'subitemsFin','subitemsOther','entry_no','universities'
             , 'birth_place','other_birthplace','addresses','address','other_address'
             ,'university','other_university','english_levels','japanese_levels'));           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         
   
        $this->validateCandi($request);
          $workplaceTxt='';
          if(is_null( $request->get('workplaceTxt'))) 
            { $workplaceTxt= $request->get('workplaceTxt');} 
      $maxnum = CommonFunction::getAutoInscrement("candidates");
       $maxcode=$maxnum+10000000;
         $cannum=substr($maxcode, -7);
         $txt_other='';
           $rd_pass = rand(1000, 9999);
          if(!empty($request->input('other_subIT'))) 
        { $txt_other.=$request->input('other_subIT').";" ;}
          if(!empty($request->input('other_subTech'))) 
        { $txt_other.=$request->input('other_subTech').";" ;}
         if(!empty($request->input('other_subLab'))) 
        { $txt_other.=$request->input('other_subLab').";" ;}
             $select_array=$this->requestArray($request);

       $itemsCop_select=array();
       $itemsCop_selectstr='';
      if (!empty($request->input('coporations_select'))){ $itemsCop_select = $request->input('coporations_select');}  
    foreach($itemsCop_select as $coporation) {  
            $itemsCop_selectstr .= $coporation.";";
      }
       $itemsCop_selectstr=rtrim($itemsCop_selectstr, "; ");
          $a=  $this->occupationArray($select_array,$cannum,$txt_other);
  
        $canidates = new Candidates([
             'code' => $cannum,
             'firstName'=> $request->get('name'),
            
          'birth' => $request->get('birthday'),
          'email' => $request->get('email'),
          'sex'  => $request->get('sex'),
           
          'mobile' => $request->get('tel'),
          'university' => $request->get('university'),
           'universityName' => $request->get('other_university'),
          'birthPlace' => $request->get('birthplaces'),
            'otherBirth' => $request->get('other_birthplace'),
          'currentAdd' => $request->get('address'),
          'eLevel' => $request->get('english'),
          'jLevel' => $request->get('japanese'),
          
             'workPlace' => $request->get('workplace'),
              'workPlaceTxt' =>$request->get('other_address'), 
             'graduatesY' => $request->get('graduate_year'),
              'graduatesM' => $request->get('graduate_month'),
             'majorsTxt'=> $request->get('department'),
              'coporations' => $itemsCop_selectstr,
             'other' => $request->get('other_certification'),
              'selfPR' => $request->get('selfPR'),
             'otherIT' => $request->get('other_subIT'),
             'otherTech' => $request->get('other_subTech'),
             'otherFin' =>$request->get('other_fin'),
               'pwd'      =>         $rd_pass,
               'fbook'      =>         $request->get('fbook'),
                ]);
               $canidates->save();
   
     $this->sendEmail($request->get('email'));
          return view('job.thank');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          
        $client = client::find($id);
      $division  = DB::table('division')
          ->where("companyid","=", $id)
          ->paginate(10);
            return view('client.editclient', compact('client','id','division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                 
       $select_array=$this->requestArray($request); 
        if (count($select_array)<1) {
        $this->validate($request,[          
          'firstName' =>  'required|email|number',
        ],[
         ' Bạn cần phải chọn ít nhất 1 ngành nghề mong muốn'          
        ]);
        
      } 
             $itemsCop_select=array();
       $itemsCop_selectstr='';
      if (!empty($request->input('coporations_select'))){ $itemsCop_select = $request->input('coporations_select');}  
    foreach($itemsCop_select as $coporation) {  
            $itemsCop_selectstr .= $coporation.";";
      }
      $itemsCop_selectstr=rtrim($itemsCop_selectstr, "; ");
            $candi =  Candidates::find($id);
            $candi->firstName =   $request->get('name');
            $candi->birth  =   $request->get('birthday');
            $candi->email  =   $request->get('email');
            $candi->sex   =   $request->get('sex');           
            $candi->mobile  =   $request->get('tel');
            $candi->university  =   $request->get('university');
            $candi->universityName  =   $request->get('other_university');
            $candi->birthPlace  =   $request->get('birthplaces');
            $candi->otherBirth  =   $request->get('other_birthplace');
            $candi->currentAdd  =   $request->get('address');
            $candi->eLevel  =   $request->get('english');
            $candi->jLevel  =   $request->get('japanese');
            $candi->workPlace  =   $request->get('workplace');
            $candi->workPlaceTxt  =  $request->get('other_address'); 
            $candi->graduatesY  =   $request->get('graduate_year');
            $candi->graduatesM  =   $request->get('graduate_month');             
            $candi->majorsTxt =   $request->get('department');
            $candi->other  =   $request->get('other_certification');
            $candi->selfPR  =   $request->get('selfPR');
            $candi->otherIT  =   $request->get('other_subIT');
            $candi->otherTech  =   $request->get('other_subTech');
            $candi->otherLab  =   $request->get('other_subLab');
            $candi->otherFin  =   $request->get('other_fin');
            $candi->other  =   $request->get('other_Item');
            $candi->fbook  =   $request->get('fbook');
            $candi->coporations     = $itemsCop_selectstr;
            $candi->save();
            $txt_other='';
          if(!empty($request->input('other_subIT'))) 
        { $txt_other.=$request->input('other_subIT').";" ;}
          if(!empty($request->input('other_subTech'))) 
        { $txt_other.=$request->input('other_subTech').";" ;}
         if(!empty($request->input('other_subLab'))) 
        { $txt_other.=$request->input('other_subLab').";" ;}
          $a=  $this->occupationArray($select_array,$candi->code,$txt_other);
                 $this->sendEmail2($request->get('email'));
          return view('job.thank2');
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     // Function 
      public function requestArray(Request $request)
      {
       $itemsIT_select=$itemsTech_select=$itemOther_select=array();
        if (!empty($request->input('itemsIT_select'))){ $itemsIT_select = $request->input('itemsIT_select');}  
        if (!empty($request->input('itemsTech_select'))){ $itemsTech_select = $request->input('itemsTech_select');}  
        if (!empty($request->input('itemOther_select'))){ $itemOther_select = $request->input('itemOther_select');}  
                      $items_select=array_merge($itemsIT_select,$itemsTech_select
                 ,$itemOther_select);
       return $items_select;
      }
       public function occupationArray($items_select,$cannum,$txt_other)
       {
        
        $coporation_list='';
        $occupation_strList='';
        $occupation_strexc='';
     
      foreach($items_select as $coporation) {  
            $coporation_list .= substr($coporation,0,3).";";
            $occupation_strList  .= $coporation.";";
            $occupation_strexc.= substr($coporation,3).";";
        }
        $coporation_list = rtrim($coporation_list, "; ");
        $occupation_strList=rtrim($occupation_strList, "; ");
        $occupation_strexc=rtrim($occupation_strexc, "; ");
          $item=Occupation::updateOrCreate(
          [
          'id'=>$cannum,
          ],
          [
           'col37'=>$occupation_strexc,
          'col38'=>$coporation_list,
          'col100'=>$occupation_strList,
          ]
          );
          $item->save();
       }
      public function validateCandi($request)
       {

            //Validate
             $this->validate($request,[
                'english'=> 'required',
                'japanese'=> 'required',
                'coporations_select'=> 'required',
                'sex' => 'required',
                'email' => 'required|email|unique:candidates',
        ],[
          'name.required' => ' The Client name field is required.'
        ]);
             $select_array=$this->requestArray($request); 
                   if (count($select_array)<1) {
        $this->validate($request,[          
          'firstName' =>  'required|email|number',
        ],[
         ' Bạn cần phải chọn ít nhất 1 ngành nghề mong muốn'          
        ]);
      } 
  if($request->input('university')=="8000")
      {
        $this->validate($request,[          
          'other_university' =>  'required',
        ],[
         ' Bạn cần phải điền tên trường đại học'          
        ]);
      }
  
    if($request->input('address')=="264")
      {
        // if ( is_null($request->input('other_address'))) {
        //  dd($request->input('other_address'));
        // }
        $this->validate($request,[          
          'other_address' =>  'required',
        ],[
         ' Bạn cần phải điền địa chỉ khác vào'          
        ]);
      }
    
      if($request->input('birth_place')=="264")
      {
         if ( is_null($request->input('other_birthplace'))) {
         dd($request->input('other_address'));
        }
        $this->validate($request,[          
          'other_birthplace' =>  'required',
        ],[
         ' Bạn cần phải điền nơi sinh khác vào'          
        ]);
      }
    
  



       }
       public function sendEmail( $email)
       {
        try {
          
            //return view('job.thank');
         $canidate_mail = DB::table('candidates')
        ->where("candidates.email","=", $email)
          ->first();
         $name=$canidate_mail->firstName;
         $id=$canidate_mail->id;
         $pwd=$canidate_mail->pwd;
                $message = "Dear {{$name}} <br><br> Cảm ơn bạn đã đăng kí tham gia SEKISHO JOBFAIR.<br><br>Dưới đây sẽ là mã số đăng ký của bạn tại JOBFAIR lần này:<br>Your entry number:<strong>  {{$id}}</strong><br>Password:<strong>  {{$pwd}}</strong><br><br> Hãy sử dụng mã số này để đăng ký vào hội trường tại quầy lễ tân.<br><br> Để thay đổi thông tin đăng kí bạn vui lòng sử dụng mã số đăng ký và mật khẩu trên để đăng nhập vào đường link dưới đây: 
    <br><br>Link: http://srv1.sekisho-vn.com/Jobfair2018/joblogined<br><br> Hẹn gặp lại bạn tại buổi JOBFAIR vào ngày 03-04/11/2018 tới đây tại Thư viện Tạ Quang Bửu - Đại học Bách Khoa Hà Nội nhé.";

        $body = "<html>\n";
        $body .= "<head>\n";
        $body .= "<meta charset='UTF-8' />\n</head>";
          $body .= "<body>\n"; 
          $body .= $message; 
          $body .= "</body>\n"; 
          $body .= "</html>\n"; 

       Mail::send('mailfb', array('name'=> $name
        ,'email'=> $email,
         'content'=> $body,
         'id' => $canidate_mail->id,
         'pwd' => $canidate_mail->pwd,

       ), function($message) use ($email)
       {

          $message->to( $email, 'Visitor')
          ->bcc('jobfair1@sekisho-vn.com', 'Reply')
          ->subject('Welcome to Sekisho jobfair 2018');
      });
        return view('job.thank');
          
        } catch (Exception $e) {
           return view('job.thank');
          
        }
       

       }
         public function sendEmail2( $email)
       {
        try {
          
            //return view('job.thank');
         $canidate_mail = DB::table('candidates')
        ->where("candidates.email","=", $email)
          ->first();
        
             $name=$canidate_mail->firstName;
         $id=$canidate_mail->id;
         $pwd=$canidate_mail->pwd;
               $message = " Dear {{$name}} <br><br> Thông tin của bạn đã được cập nhật..<br><br>Hẹn gặp bạn ở SEKISHO JOB FAIR diễn ra tại Thư viện Tạ Quang Bửu - Đại học Bách khoa Hà Nội vào ngày 03~04/11/2018. " ;
        $body = "<html>\n";
        $body .= "<head>\n";
        $body .= "<meta charset='UTF-8' />\n</head>";
          $body .= "<body>\n"; 
          $body .= $message; 
          $body .= "</body>\n"; 
          $body .= "</html>\n"; 

       Mail::send('mailfb2', array('name'=> $name
        ,'email'=> $email,
         'content'=> $body,
         'id' => $canidate_mail->id,
         'pwd' => $canidate_mail->pwd,

       ), function($message) use ($email)
       {

          $message->to( $email, 'Visitor')
          ->bcc('jobfair1@sekisho-vn.com', 'Reply')
          ->subject('Welcome to Sekisho jobfair 2018');
      });
        return view('job.thank2');
          
        } catch (Exception $e) {
           return view('job.thank2');
          
        }
       

       }
       public function editjob(Request $request)
       {
            $candidates = Candidates:: where('id', '=', $request->input('entry_no'))
           ->where('pwd', '=', $request->input('password')) ->first();
           if (empty($candidates) )
            {
             $this->validate($request,['entry_no' => 'required|email'                          
             ],['email.required' => 'pasword hoặc id nhập vào chưa đúng.'  ]);
            }
            
           
            $entry_no=$request->input('entry_no');
            $coporations =Coporations_2018_11::orderBy('sort','ASC')->get();
            $master=DB::table('master') ->orderBy('sort', 'ASC')->get();
            $workplace = $master;
            $english_levels=$master;
            $japanese_levels=$master;
            $province=Province2::orderBy('Name', 'ASC') ->get();
            $work_places=$master;
            $birth_places=$province;
            $addresses=$province;
            $universities=DB::table('universities') ->orderBy('id', 'ASC')->get();
            $items=Items::all();
            $subitemsIT =    $items;
            $subitemsTech =  $items;
            $subitemsLab =   $items;
            $subitemsFin =   $items;
            $subitemsOther = $items;
            $birthplaces=$birth_place=$other_birthplace=$address=$other_address=$university=
            $other_university='' ;
           $occupation=$this ->findOCbycode($candidates->code);
            $copArr=explode(';',$candidates->coporations);
            $useragent=$_SERVER['HTTP_USER_AGENT'];
          //  dd($copArr);
        if($this->fcMobileCheck($useragent))
      {
         return view('mobile.jobfairUDP', compact('candidates','occupation','coporations'
          ,'copArr','workplace','work_places','birth_places','subitemsIT','subitemsTech'
          ,'subitemsLab','subitemsFin','subitemsOther','universities'
          ,'birthplaces'   , 'birth_place','addresses','address','entry_no'
             ,'university','english_levels','japanese_levels','occupation'));   

      } 

            return view('job.jobfairUDP', compact('candidates','occupation','coporations','workplace'
               ,'copArr','work_places','birth_places','subitemsIT','subitemsTech','subitemsLab'
              ,'subitemsFin','subitemsOther','universities'
             , 'birth_place','addresses','address','entry_no'
             ,'university','english_levels','japanese_levels','occupation'));     
       }


       public function fcMobileCheck($useragent)
    {
      if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
      {
       return true;

      } 
      return false;

    }
        public function findOCbycode($code)
    {
      $occupation=Occupation::find($code);
      $itemsIT_select2          =array();  
      if (isset($occupation)) {
       $itemsIT_select2= explode(';', str_replace(';;', ';', $occupation->col100) );
      }
      return $itemsIT_select2;
     
    }
  

public function capchar()
    {
      $useragent=$_SERVER['HTTP_USER_AGENT'];
        dd($useragent);
    }
   
public function capcharck(Request $request)
    {
       dd("success");
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);
       dd("success");
        return "success";
    }

    // public function sekilogin(CookieJar $cookieJar,Request $request)
    // {
    //    $temptable ='';
    //    $entry_no= $request->input('entry_no');
    //    $password= $request->input('password');
    //    if($entry_no=='SekiSh0'&& $password=='P@Dw0d')
    //    {


    // $useragent=$_SERVER['HTTP_USER_AGENT'];
    // $cookieJar->queue(cookie('cookieSDFDFA', $useragent, 600));
    // if($this->fcMobileCheck($useragent))
    //   {
    //    return view('job.mobile', compact('temptable'));

    //   } 
    //   return view('job.jobfairWeb', compact('temptable'));
    // }
    //       $this->validate($request,[
    //            'password' => 'email|max:0' 
    //           ],[
    //             ' Username and password do not match'          
    //           ]);


    // }
    // public function checkSeki()
    // {
    //    $cookie1 = Cookie::get('cookieSDFDFA');

    //     if( is_null($cookie1) ){

    //      return view('mobile.sekilogin');
    //     }


    // }


     
}
