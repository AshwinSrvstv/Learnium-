<?php

{session_start();}

$Name=$Mobile=$Email=$PWD=$Address=$Category="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');  
if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];
$Colleges=$Courses=null;
$Type="";
if($_GET["category"])
{
    $Category=$_SESSION["Category"]=$_GET["category"];
    $Colleges=$db->GetResult("Select * from colleges where Category='".$Category."'");
    $Courses=$db->GetResult("Select * from courses where Category='".$Category."'");
    $Type="";
}
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
               <?php include("menu.php");?>
               <div class="container">
        <blockquote>
            <p class="text-danger">List of <?php echo $Category;?> Courses</p>
            <footer>This recommendation is based on your test score</footer>
        </blockquote>
    </div>
    <div class="container">
        <ul class="list-group">
                <?php $count=0;
                    if($Courses) while($row1=$Courses->fetch_assoc()){?>
            <li class="list-group-item">
                <a target="_blank" href="<?php echo $row1["URL"];?>"><strong><?php echo $row1["CourseName"];?></strong></a>
                <h5 class="list-group-item-heading"><?php echo $row1["Description"];?></h5>
            </li>
            <?php }?>
                        
        </ul>
        
    </div>
    <hr/>

    <div class="container">
        <blockquote>
            <p  class="text-danger">List of <?php echo $Category;?> Colleges</p>
            <footer>This recommendation is based on your test score</footer>
        </blockquote>
    </div>
    <div class="container">
        <ul class="list-group">
                <?php $count=0;
                    if($Colleges) while($row=$Colleges->fetch_assoc()){?>
            <li class="list-group-item">
                <a href="collegeinfo.php?cid=<?php echo $row["CID"];?>"><strong><?php echo $row["CollegeName"];?></strong></a>
                <h5 class="list-group-item-heading"><?php echo $row["Description"];?></h5>
            </li>
            <?php }?>
                        
        </ul>
        
    </div>
    <hr />

   

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>