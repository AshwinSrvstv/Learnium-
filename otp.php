<?php
{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');  
if(!isset($_SESSION["Mobile"])){header("location: profile.php"); return;}


if(isset($_GET["sendotp"]))
{
    
    if(!isset($_SESSION["OTP"])) { $_SESSION["OTP"]=mt_rand(100000,999999); }
    //echo $_SESSION["OTP"];
    SendSms("91".$_SESSION["Mobile"],"Your One Time Password is ".$_SESSION["OTP"]); 
    $_SESSION['OTPTime'] = time();

} 





$err="";
if (isset($_POST["OTP"])) 
{
    $Mobile =$_SESSION["Mobile"];
    $PWD =$_SESSION["PWD"];
    $Email=$_SESSION["Email"];
    $Name=$_SESSION["Name"]; 
    //$Address=$_SESSION["Address"]; 

    $OTP =$_POST["OTP"];
    if($_SESSION["OTP"]!=$OTP){$err="Invalid OTP Entered";}
    else if(isset($_SESSION["Name"]) && isset($_SESSION["Mobile"])&& isset($_SESSION["PWD"]) )
    {
       $sql="INSERT INTO users(`UserName`,`Mobile`,PWD,RegisteredOn,Email,Address) VALUES('".$Name."','".$Mobile."','".$PWD."',NOW(),'".$Email."','".$Address."');";
       if($db->NonQuery($sql))
       {
           $_SESSION["Message"]="Success-#-Registration Successful. Login Now.";
           header("location: profile.php"); return;
       }
    }
}
        
    

?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <script>
        var Counter = 89;
        setTimeout(TimeOut, 90000);
        function TimeOut()
        {
            document.getElementById("OTP").disabled = true;
            document.getElementById("alertmsg").style.display = "block";

            document.getElementById("Timer").style.display = "none";

        }
        setInterval(Timer, 1000);
        function Timer()
        {
            document.getElementById("Timer").innerText = "Time Left : " + Counter.toString()+" Seconds.";
            Counter--;
        }


    </script>
</head>

<body>
        <?php include("menu.php");?>

    <div class="container">
        <div class="media">
            <div class="media-left"><a><img class="media-object" src="assets/img/info.png" width="80"></a></div>
            <div class="media-body">
                <blockquote>
                    <p>Kindly Enter Your OTP</p>
                    <footer>You Will recieve an 6 digits Number on your registered Mobile. Valid For 90 Sec.</footer>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
    </div>
    <div class="container">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Verification </h3>
                </div>
                <div class="panel-body">
                <div id="Timer" style="display:block;" >Time Left : 90 Seconds.</div> 

                    <div id="alertmsg" style="display:none;" ><?php PrintAlert ("Otp Time Out . Please Resend your OTP.","warning");?></div> 
                    <form method="post">
                        
                        <input class="form-control" type="text" name="OTP" id="OTP" required="" placeholder="* * * * * *">
                        <br />
                        <?php if($err!="")PrintAlert($err,"warning");?>

                        <p>OTP not recieved ? <a href="otp.php?sendotp=yes">Send OTP Again.</a></p>
                        <br /><button class="btn btn-success btn-block" type="submit">Done</button></form>
                </div>
            </div>
        </div>
    </div>
    <?php include("Footer.php"); ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>