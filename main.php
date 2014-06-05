<?php
  
  require 'facebook-sdk/facebook.php';

  $facebook = new Facebook(array(
    'appId'  => getenv('FACEBOOK_APP_ID'),
    'secret' => getenv('FACEBOOK_SECRET'),
  ));

  $user_id = $facebook->getUser();

  echo $user_id;

  $basic = $facebook->api('/me');

  echo $basic;

  $user = 1017459457;
  $pids_file_name = 'pids_list';

  $raw_pids = file_get_contents($pids_file_name);
  $pids_array = explode(',', $raw_pids);

?>

<script type="text/javascript">
 buttonStatus = {}; // yes = 1, no = -1, neutral = 0

 function yesClick ( pid ) {
  updateStatus ( pid, 1 );
 }

 function noClick ( pid ) {
  updateStatus ( pid, -1 );
 }

 function updateStatus ( pid, newStatus ) {
  oldStatus = buttonStatus[pid];
  if (newStatus == oldStatus) { // set to neutral
    buttonStatus[pid] = 0;
    updateColour ( pid );
  } else {
    buttonStatus[pid] = newStatus;
    updateColour ( pid );
  }
 }

 function updateColour ( pid ) {
  newStatus = buttonStatus [pid];
  yes = "#" + pid + "_yes";
  no = "#" + pid + "_no";
  $(yes).removeClass("btn-success");
  $(no).removeClass("btn-danger");
  if (newStatus == 0) {
    $(yes).addClass("btn-default");
    $(no).addClass("btn-default");
  } else if (newStatus == 1) {
    $(yes).addClass("btn-success");
    $(no).addClass("btn-default");    
  } else {
    $(yes).addClass("btn-default");
    $(no).addClass("btn-danger");       
  }
 }

 function submitButton () {
  // check if all are marked
  for (var key in buttonStatus) {
    if (buttonStatus[key] == 0) {
      page_div = "#" + key + "_main";
      window.scrollTo(0, $(page_div).offset().top);
      $(page_div).effect("highlight", {}, 1500);
      return 0;
    }
  }
  // send data
  data = JSON.stringify(buttonStatus);
  request = $.post("write_results.php", { "data": data } );
  request.done(function( data ) {
    alert( "Data Loaded: " + data );
  });
  console.log("sent data");
 }
</script>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="../../assets/ico/favicon.ico" />

  <title>Like Minded / Relevance</title><!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Custom styles for this template -->
  <link href="jumbotron-narrow.css" rel="stylesheet" type="text/css" />
  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="dist/js/ie8-responsive-file-warning.js"></script><![endif]-->

  <script src="dist/js/ie-emulation-modes-warning.js" type="text/javascript">
</script><!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

  <script src="dist/js/ie10-viewport-bug-workaround.js" type="text/javascript">
</script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <script src="dist/js/jquery-1.10.2.js" type="text/javascript"> </script>
  <script src="dist/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"> </script>
</head>

<body>
  <div class="container">
    <div class="header">
      <ul class="nav nav-pills pull-right">
        <li class="active"><a href="#">Home</a></li>

        <li><a href="#">About</a></li>

        <li><a href="#">Contact</a></li>
      </ul>

      <h3 class="text-muted">Like Minded</h3>
    </div>

    <div class="jumbotron">
      <h1>Relevance</h1>

      <p class="lead">Do you think the pages are relevant to the query?</p>

      <p><a class="btn btn-lg btn-warning" href="#">query text</a></p>
    </div>

    <div class="row marketing">
      <div class="col-lg-1">
        &nbsp;
      </div>

      <div class="col-lg-2"><img src=
      "https://graph.facebook.com/91290503700/picture?width=75&amp;height=75" /></div>

      <div class="col-lg-6">
        <h4>Inception (Test)</h4>
      </div>

      <div class="col-lg-3">
        <button type="button" class="btn btn-success">Yes</button> <button type="button"
        class="btn btn-danger">No</button>
      </div>
    </div>

    <?php 
      foreach ($pids_array as $pid) {
        // get page name
        $page_json_raw = file_get_contents('http://graph.facebook.com/'.$pid);
        $page_data = json_decode($page_json_raw);
        ?>

        <script type="text/javascript">
        buttonStatus[ <?php echo $pid; ?> ] = 0;
        </script>

    <div class="row marketing" id="<?php echo $pid; ?>_main">
      <div class="col-lg-1">
        &nbsp;
      </div>

      <div class="col-lg-2"><img src=
      "https://graph.facebook.com/<?php echo $pid; ?>/picture?width=75&amp;height=75" /></div>

      <div class="col-lg-6">
        <h4><?php echo $page_data->name; ?></h4>
      </div>

      <div class="col-lg-3">
        <button type="button" class="btn btn-default" id="<?php echo $pid; ?>_yes" onclick="yesClick( <?php echo $pid; ?> );">Yes</button> <button type="button"
        class="btn btn-default" id="<?php echo $pid; ?>_no" onclick="noClick( <?php echo $pid; ?> );">No</button>
      </div>
    </div>
    <?php
      }
    ?>

    <div class="center-block text-center">
      <button type="button" class="btn btn-success btn-lg" onclick="submitButton();">Submit</button>
    </div>

    <div class="clearfix">
      &nbsp;
    </div>

    <div class="row marketing">
      <div class="col-lg-6">
        <h4>About</h4>

        <p>Relevance of pages will determine the success of our algorithms which we might
        or might not tell you in the end depending on whether the results are nice.</p>
      </div>

      <div class="col-lg-6">
        <h4>Contact</h4>

        <p>This is a part of a research project at Department of Computer Science and
        Engineering, IIT Delhi. A few of the people are also involved.</p>
      </div>
    </div>

    <div class="footer">
      <p>IIT Delhi, 2014</p>
    </div>
  </div><!-- /container -->
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
