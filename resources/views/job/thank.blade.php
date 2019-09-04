@extends('master2')
@section('content')
  
<div class="jumbotron text-xs-center" style="height: 100%; color: #f50707">
    <img href="/img/ticket.png">
    <h2 class="display-3">Cảm ơn bạn đã đăng ký tham gia SEKISHO JOB FAIR!</h2>
    <p class="lead">Xin hãy check email của bạn để lấy mã số đăng ký và mật khẩu.
      <br>
      Hẹn gặp lại bạn tại buổi JOB FAIR vào ngày 02~03/11/2019 tới đây tại Thư viện Tạ Quang Bửu - Đại học Bách Khoa Hà Nội.
    </p>
  
    <hr>
    <p class="lead">
      <a class="btn btn-primary btn-sm" href="//srv1.sekisho-vn.com/jobfair2019" role="button">Trở lại trang chủ</a>
    </p>
  </div>
  <style>
    .text-xs-center {
        text-align: center!important;
    }
    @media (min-width: 576px)
    .jumbotron {
        padding: 4rem 2rem;
    }
    .jumbotron {
        padding: 2rem 1rem;
        margin-bottom: 2rem;
        background-color: #eceeef;
        border-radius: .3rem;
    }
    *, ::after, ::before {
        -webkit-box-sizing: inherit;
        box-sizing: inherit;
    }

    user agent stylesheet
    div {
        display: block;
    }
  </style>

<script type="text/javascript">
    var url = "{{ url('/showDistrict') }}";
    var urlWard = "{{ url('/showWard') }}";
    $("select[name='province']").change(function(){
        var province_id = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: province_id,
                _token: token
            },
            success: function(data) {
              //   alert(url);
                $("select[name='district'").html('');
                $.each(data, function(key, value){
                    $("select[name='district']").append(
                        "<option value=" + value.Id + ">" + value.Name + "</option>"
                    );
                });
            }
        });
    });
        $("select[name='district']").change(function(){
        var district_id = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: urlWard,
            method: 'POST',
            data: {
                id: district_id,
                _token: token
            },
            success: function(data) {
               
                $("select[name='slbWard'").html('');
                $.each(data, function(key, value){
                        $("select[name='slbWard']").append(
                        "<option value=" + value.Id + ">" + value.Name + "</option>"
                    );
                });
            }
        });
    });
        $("select[name='national']").change(function(){
          var national_id = $(this).val();

          if (national_id >1) {
            //alert(national_id);
            document.getElementById("provinceID").style.display="none";
            document.getElementById("districtID").style.display="none";
            document.getElementById("wardID").style.display="none";
          // 
          } else
          { document.getElementById("provinceID").style.display="block";
            document.getElementById("districtID").style.display="block";
            document.getElementById("wardID").style.display="block";
        }

        });
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

</script>
@endsection