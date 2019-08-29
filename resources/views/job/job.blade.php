@extends('master2')
@section('content')
   <body >
<div class="container" style="background: #c6dedb" >
  <form method="post" action="{{url('jobfair')}}" autocomplete="off">

      <div class="form-class row" style="margin-bottom: 6px;">
        <div class="control-label col-sm-2">
        </div>
        <div class="control-label col-sm-7">
          <h4 style="color: #fb3d3d; font-size: 25px; font-weight: bold;text-align: center;">MẪU ĐĂNG KÝ THAM GIA SEKISHO JOB FAIR</h4>
        </div>    
        
        
      </div>
       <div class="form-group row">
         @if(count($errors))
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.
        <br/>
        <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  {{csrf_field()}}



    </div>


      <div class="form-class row" style="margin-bottom: 6px;">
      <div class="col-sm-offset-4 col-sm-6">
                  <span style="margin-left: 60px">
          <?php
            echo '<label>'.'MÃ SỐ ĐĂNG KÝ:'.'</label><b>&nbsp;'.$entry_no.'</b>' ;
          ?>
          </span> 
      </div>
          </div>
      <div class="form-class row">
        <label class="control-label col-sm-2">HỌ TÊN<span class="error">*</span></label>
        <div class="col-sm-3">
           {{csrf_field()}}
          <input type="text" placeholder="Họ tên" name="name" value="{{ old('name')}}" class="form-control
          input-text" required/>
        
          <br>
        </div>
      

        <label class="control-label col-sm-2">GIỚI TÍNH<span class="error">*</span></label>
        <div class="col-sm-3">
             <div class="radio-inline">
            <input type="radio" name="sex"
            <?php if (old('sex')=="31") echo "checked";?>
            value="31">Nam
           
          </div>
          <div class="radio-inline">
            <input type="radio" name="sex"
            <?php if ( old('sex')=="32") echo "checked";?>
            value="32">Nữ
          </div>
       
        </div>
      </div>
      
      <div class="form-class row">
        <label class="control-label col-sm-2">EMAIL<span class="error">*</span></label>
        <div class="col-sm-3">
          <input type="email" placeholder="Email" name="email" value="{{ old('email')}}" class="form-control input-text" id="email" required/>
         
          <br>
        </div>
        
        <label class="control-label col-sm-2">SỐ ĐIỆN THOẠI<span class="error">*</span></label>
        <div class="col-sm-3" style="width: 190px">
          <input type="text" placeholder="Số điện thoại" name="tel" value="{{ old('tel')}}" class="form-control" id="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
          <br>
        </div>
        
      </div>

      <div class="form-class row">
           {{csrf_field()}}
        <label class="control-label col-sm-2">NGÀY SINH<span class="error">*</span></label>
        <div class="col-sm-3">
          <input type="date" name="birthday"  value="Ngày-Tháng-Năm" min="01-01-1980" max="12-31-2001" class="form-control" required/>
          
          <br>
        </div>
        <label class="control-label col-sm-2" style="padding-top: 0px">ĐỊA ĐIỂM LÀM VIỆC<br> MONG MUỐN<span class="error">*</span></label>
        <div class="col-sm-2">
          <select name='workplace' required style="width: 159px; height: 28px;">
             <option value="" >--------</option>
       <?php 
              foreach($workplace as $en){
             if($en->type =='wplace'){
                echo "<option value='".$en->id."'";
                 if( $en->id  == old('workplace') ) echo " selected='selected'  ";
                echo ">".$en->name."</option>";
                  
                  }
              }
            ?>
          </select>
        </div>
       
      </div>

      <div class="form-class row" style="margin-bottom: 20px;">
        <label class="control-label col-sm-2">QUÊ QUÁN<span class="error">*</span></label>
        <div class="col-sm-3">
          <select name='birthplaces' required  
          onchange='CheckOtherQ(this.value, "other-birthplace","264")'
           style="width: 130px; height: 28px; float: left">
             <option value="" >--------</option>
            <?php 
              foreach($birth_places as $birthPlace) { 
                echo "<option value='".$birthPlace->Id."'";
               if( $birthPlace->Id  ==  old('birthplaces') ) echo " selected='selected'  ";
                echo ">".$birthPlace->Name."</option>";
            }
            ?>
             <option value="264" >Other</option>
          </select>
          
          <input type="text" class="form-control" name="other_birthplace" placeholder="Quê quán" id="other-birthplace" style='width: 128px; margin-left: 135px; 
          display:<?php  if ($birth_place=="264" or old('birth_place')=="264"  ) {echo "block";} else {echo "none";}?>; height: 28px;' >
         
        </div>
      
        <label class="control-label col-sm-2">ĐỊA CHỈ HIỆN TẠI<span class="error">*</span></label>
        <div class="col-sm-2">
          <select name='address' required 
          onchange='CheckOtherQ(this.value, "other-address","264")'
            style="width: 160px; height: 28px;">
           <option selected="selected" value="" ><span style="color: #d2c8c8">--------</span></option>
            <?php 
              foreach($addresses as $addr) {
                echo "<option value='".$addr->Id."'";
                  if( $addr->Id  == old('address') ) echo " selected='selected'  ";
                echo ">".$addr->Name."</option>";
              }
            ?>
             <option value="264" >Other</option>
          </select>
        </div>
        <div class="col-sm-2">
          <input type="text" class="form-control" placeholder="Địa chỉ hiện tại" name="other_address" id="other-address" style='display:<?php if ($address=="264" or  old('address')=="264" ) {echo "block";} else {echo "none";}?>; height: 28px;' >
         
        </div>
      </div>

      <div class="form-class row" style="margin-top: 20px; margin-bottom: 20px">
        <label class="control-label col-sm-2">TRƯỜNG ĐẠI HỌC<span class="error">*</span></label>
        <div class="col-sm-4">
          <select name='university' required 
          onchange='CheckOtherQ(this.value, "other-university","8000");' 
          style="width: 260px; height: 28px;">
            <option selected="selected" ><span style="color: #d2c8c8">--------</span></option>
            <?php 
              foreach($universities as $u) {
                echo "<option value='".$u->id."'";
                 if( $u->id  == old('university') ) echo " selected='selected'  ";
                echo ">".$u->name."</option>";
              }
            ?>
          </select>
          <br>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-2" style="width: 190px">
          <input type="text" placeholder="Tên trường đại học" class="form-control" name="other_university" id="other-university" style='display:<?php if ($university=="8000" or  old('university')=="8000" ) {echo "block";} else {echo "none";}?>; height: 28px;' >   
        </div>
      </div>

      <div class="form-class row">
        <label class="control-label col-sm-2">CHUYÊN NGÀNH<span class="error">*</span></label>
        <div class="col-sm-3">
          <input type="text" name="department" placeholder="Chuyên ngành học"  value="{{ old('department')}}"  class="form-control" required/>
         
        </div>

        <label class="control-label col-sm-2" style="padding-top: 0px">TRÌNH ĐỘ TIẾNG ANH (TOEIC)
          <span class="error">*</span></label>
        <div class="col-sm-3">
          <select name='english' required style="width: 159px; height: 28px;">
          <option selected="selected" value="" ><span style="color: #d2c8c8">--------</span></option>
           <?php 
              foreach($english_levels as $en){
             if($en->type =='eng'){
                echo "<option value='".$en->id."'";
                 if( $en->id  == old('english') ) echo " selected='selected'  ";
                echo ">".$en->name."</option>";
                  
                  }
              }
            ?>
          </select>
         
        </div>
      </div>

      

      <div class="form-class row" style="margin-bottom: 10px; margin-top: 20px">
        
        <label class="control-label col-sm-2"style="padding-top: 0px">THỜI GIAN <br> TỐT NGHIỆP<span class="error">*</span></label>
        <div class="col-sm-3">
          <select name="graduate_year" required style="height: 28px; width: 75px;">
            <option value=''<?php if(empty($year)) echo "checked" ?>>Năm</option>
            <?php foreach (range(2002, 2022) as $i) {
              echo "<option value='".$i."'";
                if( $i  == old('graduate_year') ) echo " selected='selected'  ";
              echo ">".$i."</option>";
            }?>
          </select>
          
          <select name="graduate_month" required style="height: 28px; width: 80px;">
            <option value=''<?php if(empty($month)) echo "checked" ?>>Tháng</option>
            <?php foreach (range(1, 12) as $i) {
              echo "<option value='".$i."'";
                if( $i == old('graduate_month') ) echo " selected='selected'  ";
              echo ">".$i."</option>";
            }?>
          </select>
          
        </div>
        
        <label class="control-label col-sm-2" style="padding-top: 0px">TRÌNH ĐỘ TIẾNG NHẬT (JLPT)<span class="error">*</span></label>
        <div class="col-sm-2">
          <select name='japanese' required style="height: 28px; width: 160px">
          <option selected="selected" value="" ><span style="color: #d2c8c8">--------</span></option>
             <?php 
              foreach($japanese_levels as $ja) {
                if($ja->type =='jp'){
                echo "<option value='".$ja->id."'";
                   if( $ja->id  == old('japanese') ) { echo " selected='selected'  ";  } 
                echo ">".$ja->name."</option>";
              }
            }
            ?>
          </select>
     
        </div>
      </div>

      <div class="form-class row">
        <label class="control-label col-sm-2">CÁC KỸ NĂNG KHÁC</label>
        <div class="col-sm-3">
          <textarea name="other_certification"  style="resize:none"  placeholder="VD: JAVA, C++, CAD..."   value="{{ old('other_certification')}}"  class="form-control" ></textarea>
        </div>
        <label class="control-label col-sm-2">PR BẢN THÂN</label>
        <div class="col-sm-3">
          <textarea name="selfPR"  style="resize:none"  placeholder="VD: Đã từng đi Nhật..."  value="{{ old('selfPR')}}" class="form-control" ></textarea>
        </div>
      </div>
      <br>
      <div class="form-class row">
        <label class="control-label col-sm-2">LINK FACEBOOK <br> CỦA BẠN</label>
        <div class="col-sm-5">
          <input type="text" name="fbook" placeholder="Link Facebook"  value="{{ old('fbook')}}"  class="form-control" />
        </div>
       </div>   
           <div class="form-class row" style="margin-top: 10px">
        <label class="control-label col-sm-7">CÔNG TY BẠN QUAN TÂM<span class="error">*</span></label>
      </div>
      <div class="form-class row" style="margin-top: 10px">
        
              <label class="control-label col-sm-2" > </label>
        
               <div class="col-sm-10">
          <div class="row">
              
            <?php 
              foreach($coporations as $copor){

                echo "<div class='col-sm-4' ><input type='checkbox' name='coporations_select[]'  value='".$copor->name."'";
          
              if(in_array($copor->name, old('coporations_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";                
              }
            ?>
              
            </div>
            </div>
            <div class='col-sm-2'></div>
      </div>
      <div class="form-class row" style="margin-top: 10px">
        <label class="control-label col-sm-7">NGÀNH NGHỀ MONG MUỐN<span class="error">*</span></label>
     
      </div>
      <div class="form-class row" style="margin-top: 10px">
            <label class="control-label col-sm-2">Lĩnh vực IT </label>
        
    

        
        <div class="col-sm-10">
          <div class="row">
            <div class="checkbox-group required">
            <?php 
              foreach($subitemsIT as $copor){
                 if($copor->code =='1'){
                echo "<div class='col-sm-4'><input type='checkbox' name='itemsIT_select[]' value='".$copor->val."'";
                if(in_array($copor->val, old('itemsIT_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";
              }
              }
            ?>

      
          </div>
          </div>
        <div class="row-col-sm-4" style="width: 260px;margin-left: 10px">
          <input type="text" placeholder="Lĩnh vực IT Khác" 
        value="{{ old('other_subIT')}}"   class="form-control" name="other_subIT" id="other_subIT" >    
        </div>
        

        </div>
      </div>
      <div class="form-class row" style="margin-top: 10px">     
        <label class="control-label col-sm-2">Lĩnh vực kỹ thuật</label>
        <div class="col-sm-10">
          <div class="row">
            <?php 
              foreach(  $subitemsTech as $copor){
                 if($copor->code =='2'){
                echo "<div class='col-sm-4'><input type='checkbox' name='itemsTech_select[]'
                 value='".$copor->val."'";
                  if(in_array($copor->val, old('itemsTech_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";
              }
            }
            ?>  
        </div>
        <div class="row-col-sm-4" style="width: 260px;margin-left: 10px">
          <input type="text" placeholder="Lĩnh vực kĩ thuật khác" 
          value="{{ old('other_subTech')}}"  class="form-control" name="other_subTech" id="other_subTech" >
          </div>
      </div>
    </div>
  
      <div class="form-class row" style="margin-top: 10px">     
        <label class="control-label col-sm-2">Lĩnh vực nghiên cứu</label>
        <div class="col-sm-10">
          <div class="row">
         <?php 
              foreach($subitemsIT as $copor){
                 if($copor->code =='3'){
                echo "<div class='col-sm-4'><input type='checkbox' name='itemsIT_select[]' value='".$copor->val."'";
                if(in_array($copor->val, old('itemsIT_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";
              }
              }
            ?>
      
          </div>
          <div class="row-col-sm-4" style="width: 260px;margin-left: 10px">
          <input type="text" placeholder="Lĩnh vực nghiên cứu khác" 
          value="{{ old('other_subLab')}}"  class="form-control" name="other_subLab" id="other_subLab" >
          </div>
        </div>
      </div>
      <div class="form-class row" style="margin-top: 10px">     
        <label class="control-label col-sm-2">Lĩnh vực tài chính, bảo hiểm</label>
        <div class="col-sm-10">
          <div class="row">
         <?php 
              foreach($subitemsIT as $copor){
                 if($copor->code =='4'){
                echo "<div class='col-sm-4'><input type='checkbox' name='itemsIT_select[]' value='".$copor->val."'";
                if(in_array($copor->val, old('itemsIT_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";
              }
              }
            ?>
      
          </div>
          <div class="row-col-sm-4" style="width: 260px;margin-left: 10px">
          <input type="text" placeholder="Lĩnh vực tài chính khác" 
          value="{{ old('other_fin')}}"  class="form-control" name="other_fin" id="other_fin" >
          </div>

        </div>
      </div>
     

      <div class="form-class row" style="margin-top: 10px">     
        <label class="control-label col-sm-2">Lĩnh vực khác </label>
        <div class="col-sm-10">
          <div class="row">
            <?php 
              foreach($subitemsOther as $copor){
                 if($copor->code =='5'){
                echo "<div class='col-sm-4'><input type='checkbox' name='itemsIT_select[]' 
                value='".$copor->val."'";
               if(in_array($copor->val, old('itemsIT_select', [])))  echo "checked";
                echo "> ".$copor->name."</div>";
              }
            }
            ?>
            </div>
          <div class="row-col-sm-4" style="width: 260px;margin-left: 10px">
          <input type="text" placeholder="Lĩnh vực khác" class="form-control" 
           value="{{ old('other_Item')}}" name="other_Item" id="other_Item" >
          </div>
          

        
      </div>
        </div>
      <div class="form-class row" style="margin-top: 10px">
        <label class="control-label col-sm-2"</span></label>
        <div class="col-sm-10">
     <!--      <div class="row">
                  <label for="ReCaptcha">Recaptcha:</label>
          {!! NoCaptcha::renderJs() !!}
          <!-- {!! NoCaptcha::display() !!} -->
      
          </div> 
      
        <div>
      </div>
  

            <div class="form-class">

            <div class="col-sm-offset-3 col-sm-6" style="margin-top: 20px">
                
              <button type="submit" style="width: 150px; height: 50px; font-size: 25px" 
             class="btn btn-primary" id="button1">Đăng ký</button>
            </div>
        </div>
        </div>
      </div>
    </form>
  </div>

<script type="text/javascript">
  
     $( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1960:1999',
        dateFormat : 'yy-mm-dd',
        defaultDate: '01-01-1985'
    });
  } );

     function validate(evt) 
     {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
   var regex = /[0-9]|\+|\/|\-/;
  var regexJ = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();

  }
if(regexJ.test(key)) {
     theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
}
else {
    console.log("No Japanese characters");
}

   }
   function CheckOther(val, class_check){
      var element=document.getElementById(class_check);
      if(val=='100')
          element.style.display='block';
      else  
          element.style.display='none';
    }
      function CheckOtherbirth(val, class_check){
      var element=document.getElementById(class_check);
      if(val=='1')
          element.style.display='block';
      else  
          element.style.display='none';
    }
       function CheckOtherQ(val, class_check,valOther){
      var element=document.getElementById(class_check);
      if(val==valOther)
          element.style.display='block';
      else  
          element.style.display='none';
    }

     function disableSubmit(){
      document.getElementById("button1").disabled = true;
    };
    function enableBtn(){
        document.getElementById("button1").disabled = false;
      }

</script>
</body>
@endsection