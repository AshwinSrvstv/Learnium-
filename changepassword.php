<?PHP
{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');

$UID=1;$SuccessMsg="";
if(isset($_SESSION["UID"])){$UID=$_SESSION["UID"];}else{header("Login.php");return;}
$err=$CID="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $OldPWD=$_POST["OldPWD"];
    $PWD=$_POST["NewPWD"];
    $REPWD=$_POST["REPWD"];
    if($PWD != $REPWD){$err="New Passwords MisMatch !!!";}
    else if($db->ScalerQuery("select PWD from users where UID=".$UID)!=$OldPWD){$err="Incorrect Old Password";}
    
    else{
        $sql="UPDATE `users` SET `PWD`='". $PWD."' WHERE UID=".$UID;
        if($db->NonQuery($sql))$SuccessMsg="Password Changed Successfully !!!";
        else $err="An Error Occurred !!";
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
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
</head>

<body>
    <?php include("menu.php"); ?>

    <div class="container">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3></div>
                <div class="panel-body">
                 <?php if($err!="") {  PrintAlert($err,"danger"); }?>

                <?php if($SuccessMsg!="") { PrintAlert($SuccessMsg,"success"); }?>

                    <form method="post" action="changepassword.php">
                        <input class="form-control" type="password" name="OldPWD" placeholder="Old Password">
                        <p> </p>
                        <input class="form-control" type="password" name="NewPWD" placeholder="New Password">
                        <p> </p>
                        <input class="form-control" type="password" name="REPWD" placeholder="Retype New Password">
                        <p> </p>
                        <button class="btn btn-success btn-block" type="submit">Change Password</button>
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