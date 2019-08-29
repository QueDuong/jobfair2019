<html lang="en">
<head>
    <title>reCAPTCHA Code in Laravel</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">   
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>
<body onload="disableSubmit()">
<div class="container">
      <h2>reCAPTCHA Code in Laravel</h2><br/>
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
     <form method="post" action="{{url('jobfair')}}" autocomplete="off">
          {{csrf_field()}}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Name">Name:</label>
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Email">Email:</label>
              <input type="text" class="form-control" name="email">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="Password">Password:</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
          <label for="ReCaptcha">Recaptcha:</label>
          {!! NoCaptcha::renderJs() !!}
          <!-- {!! NoCaptcha::display() !!} -->
          <div class="g-recaptcha" 
          data-sitekey="6Ldq32kUAAAAAFVSpjp1Py4OdtJc05Dus_8DGmZL" data-callback="enableBtn" style="margin-top: 20px"></div>
            </div>
        </div>
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" id="button1" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
      <script type="text/javascript">
    function disableSubmit(){
      document.getElementById("button1").disabled = true;
    };
    function enableBtn(){
        document.getElementById("button1").disabled = false;
      }
  </script>
</body>
</script>
</html>