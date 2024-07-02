<?php

{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');
$ExamType="HighSchool";



//if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];


if(isset($_GET["delete"])){$db->NonQuery("delete from colleges where CID=".$_GET["delete"]); header("location: colleges.php"); return;}

$Questions=$db->GetResult("SELECT * FROM questions where ExamType='HighSchool'");
if(isset($_POST["SubmitTest"]))
{
    $PCM=0;
    $Law=0;
    $PCB=0;
    $Arts=0;
    $Commerce=0;
    //=$db->GetResult("select QID");
    $CorrectAnswersList=$db->GetResult("select QID,CorrectAnswer from questions where ExamType='HighSchool'");
    $n=0;
    while($row=$CorrectAnswersList->fetch_assoc())
    {
        $n++;
        $Answer=$_POST["Q".$row["QID"]."A"];
        $CorrectAnswers=$row["CorrectAnswer"];
        if($Answer==$CorrectAnswers)
        {
            if($n>0&& $n<11)  $PCM=$PCM+10;
            if($n>10&& $n<21)  $Law=$Law+10;
            if($n>20&& $n<31)  $PCB=$PCB+10;
            if($n>30&& $n<41)  $Arts=$Arts+10;
            if($n>40&& $n<51)  $Commerce=$Commerce+10;
        }
    }
    $_SESSION["Marks"]["PCM"]=$_SESSION["PCM"]=$PCM;
    $_SESSION["Marks"]["PCB"]=$_SESSION["PCB"]=$PCB;
    $_SESSION["Marks"]["Arts"]=$_SESSION["Arts"]=$Arts;
    $_SESSION["Marks"]["Commerce"]=$_SESSION["Commerce"]=$Commerce;
    $db->NonQuery("INSERT INTO `results`(`UID`,`TestDateTime`,`PCM`,`PCB`,`Law`,`Arts`,`Commerce`,ExamType) VALUES(".$UID.",NOW(),".$PCM.",".$PCB.",".$Arts.",".$Commerce.",'HighSchool');");
    $RID = $db->ScalerQuery("Select MAX(RID) from results ");
    header("location: testresult.php?RID=".$RID);return;




}



?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
       <?php include("menu.php");?>

    <div class="container">
        <blockquote>
            <p>Quick Test</p>
            <footer>Someone famous</footer>
        </blockquote>
    </div>
    
    <?php if($Questions->num_rows>0){ ?>

<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Quick Test || Analyzer</h3>
            </div>
            

            <div class="panel-body">
                <form method="post">
                    <input hidden name="SubmitTest" value="yes" />
                    <input hidden name="ExamType" value="<?php echo $ExamType; ?>" />

                    <ul class="list-group">
                         <?php $count=0;
                               if($Questions) while($row=$Questions->fetch_assoc()){
                                   ++$count;
                                   ?>
                        <li class="list-group-item"><span><?php echo $row["Question"];?></span>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <div class="radio"><label><input type="radio" required name="Q<?php echo $row["QID"]; ?>A" style="width: 15px;" value="<?php echo $row["Option1"];?>"><?php echo $row["Option1"];?></label></div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="radio"><label><input type="radio" required name="Q<?php echo $row["QID"]; ?>A" style="width: 15px;" value="<?php echo $row["Option2"];?>"><?php echo $row["Option2"];?></label></div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="radio"><label><input type="radio" required name="Q<?php echo $row["QID"]; ?>A" style="width: 15px;" value="<?php echo $row["Option3"];?>"><?php echo $row["Option3"];?></label></div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="radio"><label><input type="radio" required name="Q<?php echo $row["QID"]; ?>A" style="width: 15px;" value="<?php echo $row["Option4"];?>"><?php echo $row["Option4"];?></label></div>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                        <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-12"><button class="btn btn-success btn-block" type="submit">Submit your Test for Evaluation</button></div>
                        </div>
</li>
                       
                    </ul>
                </form>
            </div>
        </div>
    </div>
            <?php }?>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>