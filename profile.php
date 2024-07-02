<?php
session_start();
include('assets/Database/DBMySql.php');$db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');

$err="";$ReadOnly="readonly";

if(!isset($_SESSION["UID"]) && !isset($_GET["uid"])){header("Location: Login.php");return;}
if(isset($_SESSION["UID"])){ $UID=$_SESSION["UID"];}
if(isset($_GET["uid"])){ $UID=$_GET["uid"];}



if(isset($_POST["Name"]))
{
    $Name=$_POST["Name"];
    $Mobile=$_POST["Mobile"];
    $Email=$_POST["Email"];
    $_SESSION["ExamType"]=$EnrolledFor=$_POST["EnrolledFor"];
    $db->NonQuery("UPDATE users set UserName='".$Name."',Mobile='".$Mobile."',Email='".$Email."',EnrolledFor='".$EnrolledFor."' where UID=".$UID);
    $_SESSION["Message"]="success-#-Information Updated Successfully.";

}

$UserRow=$db->GetSingleRow("select * from users where UID=".$UID);
$IsProfileOwner=$_SESSION["UID"]==$UID;
if($IsProfileOwner)$ReadOnly="";
$EnrollmentType = SelectOptionsFormArray(array("HighSchool","Intermediate"),$UserRow["EnrolledFor"]);

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Hero-Technology.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
        <?php include ("menu.php");?>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><span>Profile Details</span></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 text-center"><img src="assets/img/user-128.png"></div>
                    <div class="col-lg-9 col-md-9">
                        <form method="post">
                            <div class="table-responsive">
                                <table class="table">
                                    <caption><?php if($_SESSION["Message"]!="")PrintSmartAlert($_SESSION["Message"]);$_SESSION["Message"]=""; ?></caption>

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th><input class="form-control" type="text" name="Name" value="<?php echo $UserRow["UserName"];?>" <?php echo $ReadOnly; ?>></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Mobile</td><td><input class="form-control" type="text" name="Mobile" value="<?php echo $UserRow["Mobile"];?>"  <?php echo $ReadOnly; ?>></td></tr>
                                        <tr><td>Email</td><td><input class="form-control"  name="Email" value="<?php echo $UserRow["Email"];?>"  <?php echo $ReadOnly; ?>/></td>
                                            <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] !="Admin") {?>
                                        <tr><td>Enrolled For</td><td><select class="form-control" name="EnrolledFor"  <?php echo $ReadOnly; ?>><?php echo $EnrollmentType;?></select></td>
                                            <?php }?>
                                        </tr><?php if($IsProfileOwner){?> 
                                        <tr><td></td>
                                            <td class="text-right"><button class="btn btn-success" type="submit">Update</button></td>
                                        </tr><?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-footer"><a class="btn btn-primary" href="changepassword.php">Change Password</a></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>