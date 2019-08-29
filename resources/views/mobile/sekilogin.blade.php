<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="keywords" content="Jobs in need are jobs indeed" />
    <meta name="description" content="Jobs in need are jobs indeed" />
    <meta name="robots" content="index, follow" />
    <meta name = "alexaVerifyID" content = "1qN4FGcM5bHSYuEmnRvYfcdrsBo" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
      <title>JOB FAIR | SEKISHO</title>
    <link rel="pingback" href="http://www.willworks.com.vn/xmlrpc.php" />
          <link rel="shortcut icon" href="http://www.willworks.com.vn/wp-content/uploads/2016/05/icontab.png"/>
        <!-- enqueue json library for ie 7 or below -->
    <!--[if LTE IE 7]>
        <![endif]-->
    
    <!-- All in One SEO Pack 2.3.9.1 by Michael Torbert of Semper Fi Web Design[870,897] -->
    <link rel="canonical" href="http://www.willworks.com.vn/job-fair-2017-11/" />
    <!-- /all in one seo pack -->
    <link rel='dns-prefetch' href='//ajax.googleapis.com' />
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../views/bootstrap/js/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="../views/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">

      input[type=text], input[type=password] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
      }

      button {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
      }

      button:hover {
          opacity: 0.8;
      }


      .imgcontainer {
          text-align: center;
          margin: 24px 0 12px 0;
      }

      .container {
          padding: 16px;
      }

      span.psw {
          float: right;
          padding-top: 16px;
      }
    </style>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
 <form method="GET" action="{{ url('sekilogin') }}">
    <input name="_method" type="hidden" value="PATCH">


      <div class="container" style="width:500px">
          {{csrf_field()}}
        <div style="margin-left: 140px;">
          <h3>Login</h3>
        </div>
                 <div class="form-group row">
         @if(count($errors))
      <div class="alert alert-danger">
        <strong>Username and password do not match !</strong> 
      </div>
    @endif
  {{csrf_field()}}



    </div>
        <?php if(isset($error) && $error == true): ?>
          <p style="color:red; margin-left: 20px">Entry number or password is incorrect!</p>
        <?php endif; ?>

          <div class="form-group">
            <div class="col-sm-10">
                <input style="border-radius: 3px" type="text" placeholder="Enter your user" name="entry_no" required>
                 
            </div>
          </div>
        <div class="form-group">
            <div class="col-sm-10"> 
                <input style="border-radius: 3px" type="password" placeholder="Enter Password" name="password" required>
            </div>
        </div>

                <button type="submit" class="btn btn-primary" style="width: 150px; margin-left: 110px">Submit</button><br>
        <br>
        <a href="/jobfair/26042018" style="margin-left: 110px">Quay lại trang chủ</a>
        </div>
    </form>
  </body>
</html>