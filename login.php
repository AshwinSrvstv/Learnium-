<?php
session_start();
include('assets/phpscript/FormatedOutput.php');
$err="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('assets/Database/DBMySql.php');$DB=new DBMySql;
    $Email =  $_POST["Email"];

    $PWD =  $_POST["PWD"];


    $sql="select count(*) from `users` where `Email` ='".$Email."' and `PWD` ='".$PWD."';";
    // echo $DB->ScalerQuery($sql);
    if( $DB->ScalerQuery($sql)=="1")
    {
        $row= $DB->GetSingleRow("select * from `users` Where `Email` ='".$Email."' and `PWD` ='".$PWD."'");
        $UID=$_SESSION["UID"]=$row["UID"];
        $_SESSION["UserName"]= $row["UserName"];
        $_SESSION["UserType"]= $row["UserType"];
        $_SESSION["ExamType"]= $row["EnrolledFor"];
        $_SESSION["EnrolledFor"]= $row["EnrolledFor"];
        $_SESSION["Email"]=$Email;
        $_SESSION['LAST_ACTIVITY'] = time();


        header("Location: testresult.php?RID=3"); return;


        header("Location: profile.php");return;
    }
    else{ $err="Invalid Credentials";}


}
?>




<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php include ("menu.php");?>
    <div class="login-card"><img src="assets/img/user-128.png" class="profile-img-card">
        <p class="profile-name-card"> </p>
        <form class="form-signin" method="post"><span class="reauth-email"> </span>
            <?php if($err!="")PrintAlert($err,"warning");?>
            <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"]!="")PrintSmartAlert($_SESSION["Message"]);$_SESSION["Message"]="";?>

            <input class="form-control" type="email" name="Email" required="" placeholder="Email" autofocus="" id="inputEmail">
            <input class="form-control" type="password" name="PWD" required="" placeholder="Password" id="inputPassword">
            <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit">Enter</button></form>
        
        <a href="signup.php" class="forgot-password">New User ?</a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>