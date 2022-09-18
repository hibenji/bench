<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);

// show all errors
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Benchmarks" property="og:title">
    <meta content="Benchmarks and comparison of cloud game streaming providers" property="og:description">
    <meta content="https://bench.benji.link" property="og:url">
    <meta content="/assets/controller.png" property="og:image">
    <meta content="#5a43b5" data-react-helmet="true" name="theme-color">
   
    <title>Benchmarks of Game Streaming Providers - Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/dark-min.css" />
    <link rel="stylesheet" type="text/css" href="assets/custom.css" />

    <script async src="https://arc.io/widget.min.js#a24jhCmw"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-50TJ289NGW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-50TJ289NGW');
    </script>

  </head>
  <body>

  <?php

  include('conn.php');
  
  if(isset($_POST['submit'])) {


    $discord = $_POST['discord'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $question = $_POST['question'];

    // check if fields are empty
    if(empty($discord)) {
      $discord = "Not Specified";
    }
    if(empty($email)) {
      $email = "Not Specified";
    }


    echo "Thank you, your Feedback was submitted!";

    // discord webhook

    $json_data = json_encode([
      "content" => "<@499865877945253888>",
          "embeds" => [
              [
                 "title" => "New Feedback!", 
                 "description" => "", 
                 "color" => 8585048, 
                 "fields" => [
                    [
                      "name" => "Message", 
                      "value" => $message, 
                    ], 
                    [
                       "name" => "Discord", 
                       "value" => $discord, 
                       "inline" => true 
                    ], 
                    [
                      "name" => "Email", 
                      "value" => $email, 
                      "inline" => true 
                    ],
                    [
                      "name" => "Contact?", 
                      "value" => $question, 
                      "inline" => true
                    ] 
                 ] 
              ] 
           ]
  
  ]);
  
  $ch = curl_init( $webhook_url );
  
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  
  curl_setopt( $ch, CURLOPT_POST, 1);
  
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
  
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
  
  curl_setopt( $ch, CURLOPT_HEADER, 0);
  
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
  
  $response = curl_exec( $ch );
  
  curl_close( $ch );
  

  }

  ?>

  <section class="section">
    <div class="container">
      <h1 class="title">
        Benchmarks of Game Streaming Providers
      </h1>
      <br>

      <p class="subtitle">

        <!-- button to hourly and monthly -->
        <a href="/" class="button is-primary">Back</a>
        <a href="hourly.php" class="button is-primary">Hourly</a>
        <a href="monthly.php" class="button is-primary">Monthly</a>

        <br>
        <br>

        <form action="feedback.php" method="post">
          <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input class="input" name="discord" id="discord"  type="text" placeholder="Benji#1652">
            </div>
          </div>

          <div class="field">
            <label class="label">Email</label>
            <div class="control">
              <input class="input" name="email" id="email" type="email" placeholder="example@example.com">
            </div>
          </div>

          <div class="field">
            <label class="label">Message *</label>
            <div class="control">
              <textarea class="textarea" name="message" id="message" placeholder="Your Message" required></textarea>
            </div>
          </div>

          <div class="field">
            <label class="label">Are you willing to be contacted by me?</label>
            <div class="control">
              <label class="radio">
                <input type="radio" value="YES" name="question" checked>
                Yes
              </label>
              <label class="radio">
                <input type="radio" value="NO" name="question">
                No
              </label>
            </div>
          </div>

          <div class="field is-grouped">
            <div class="control">
              <input name="submit" type='submit' value="Submit" class="button is-link"/>
            </div>
          </div>
        </form>
      </p>
    
    </div>
  </section>


  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Benchmarks</strong> by <a href="https://benji.link">Benji</a>.<br>
        If you have any problems or suggestions, please contact me on discord: Benji#1652 <br>
        Email: benjibordne@outlook.com
      </p>
    </div>
  </footer>

  </body>
</html>


