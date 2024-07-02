<?PHP
if(session_status()==1){session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";

include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');

$Mobile=$SuccessMsg="";
//if(isset($_SESSION["UID"])){$UID=$_SESSION["UID"];}else{header("Location: Login.php");return;}
$err=$CID="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $Email=$_POST["Email"];
   // $PWD=$_POST["NewPWD"];
    //$REPWD=$_POST["REPWD"];
    if($db->ScalerQuery("select Count(*) from users where Email='".$Email."'")=="0"){$err="Incorrect Email Entered";}
    else{
        $PWD=$db->ScalerQuery("select PWD from users where Email='".$Email."'");
        $Mobile=$db->ScalerQuery("select Mobile from users where Email='".$Email."'");
        SendSms($Mobile,$Name.", Your Password ".$PWD ); 
        $_SESSION["Message"] ="success-#-Password Sent Successfully !!!";
        header("location: login.php");return;
    }
}


?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body>
                <?php include("menu.php"); ?>

    <div class="container">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Forgot Password</h3></div>
                <div class="panel-body">
                <?php if($err!="") { PrintAlert($err,"danger"); } ?>
                <?php if($SuccessMsg!="") {  PrintAlert($err,"danger"); }?>              
                        <?php if($Mobile!="") {?> <p>Your Password has been Sent to your Registered Mobile number +91 - ######<?php echo substr($Mobile,6); ?> ... </p><?php }?>
                    <form method="post" action="ForgotPassword.php">
                        <input class="form-control" type="email" name="Email" placeholder="Enter Email ID">
                        <p> </p>
                        <button class="btn btn-success btn-block" type="submit">Proceed </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <?php include("footer.php"); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>