<?php 

  require 'facebook-sdk/facebook.php';

  $facebook = new Facebook(array(
    'appId'  => getenv('FACEBOOK_APP_ID'),
    'secret' => getenv('FACEBOOK_SECRET'),
  ));

  $main_url = 'http://boiling-sea-9988.herokuapp.com/main.php';
  $loginUrl = $facebook->getLoginUrl(array(
        'redirect_uri' => $main_url
      ));

  // echo $loginUrl;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Like Minded / User feedback</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="dist/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="dist/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <h3 class="text-muted">Like Minded</h3>
      </div>

      <div class="jumbotron">
        <h1>User feedback</h1>
        <p class="lead"> The Like Minded project needs your feedback! 
        Please login below to continue. </p>
        <p><a class="btn btn-lg btn-primary" href="<?php echo $loginUrl; ?>" role="button">Login with Facebook</a></p>
      </div>

    <div class="row marketing">
      <div class="col-lg-6">
        <h4>About<a name="about">&nbsp;</a></h4>

        <p>Like Minded is a pursuit in improving search through social data, and it needs your help 
        to determine the strength of our algorithms. The data you share with us will be anonymized
        and secure and only be used for research purposes.</p>

      </div>

      <div class="col-lg-6">
        <h4>Contact<a name="contact">&nbsp;</a></h4>

        <p>Like Minded is a research project at the Department of Computer Science and
        Engineering, IIT Delhi. For more information please 
        <a href="mailto:mt5090504@maths.iitd.ac.in">email us</a>!</p>
      </div>
    </div>


      <div class="footer">
        <p>IIT Delhi, 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
