<?php

{session_start();}

$Name=$Mobile=$PCM=$PCB=$Address=$RID=$Suggestion="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$RID=$_SESSION["RID"]=$_GET["RID"];
$UID=$_SESSION["UID"];
$ExamType = $db->ScalerQuery("Select ExamType from results where RID=".$RID);
//$_SESSION["Marks"]=arsort($_SESSION["Marks"]);
//$Subject = array_keys($_SESSION["Marks"])[0];
//if($ExamType=="Intermediate"){
//    if($Subject=="Engineering"){$Suggestion="By Our Analysis we recommend you to choose Science Studies";}
//    if($Subject=="Medical"){$Suggestion="By Our Analysis we recommend you to choose Medical Studies";}
//    if($Subject=="Law"){$Suggestion="By Our Analysis we recommend you to choose Juridicial Studies";}
//    if($Subject=="Commerce"){$Suggestion="By Our Analysis we recommend you to choose Management Studies";}
//    if($Subject=="Arts"){$Suggestion="By Our Analysis we recommend you to choose Civil Studies";}
//}
//if($ExamType=="HighSchool"){
//    if($Subject=="PCM"){$Suggestion="By Our Analysis we recommend you to choose Science Studies";}
//    if($Subject=="PCB"){$Suggestion="By Our Analysis we recommend you to choose Medical Studies";}
//    if($Subject=="Commerce"){$Suggestion="By Our Analysis we recommend you to choose Management Studies";}
//    if($Subject=="Arts"){$Suggestion="By Our Analysis we recommend you to choose Civil Studies";}
//}

$Result = $db->GetSingleRow("Select * from results where RID=".$RID);



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
            <p>Test Score Summery.</p>
            <footer>Score Based on ur Test</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Quick Test || Analyzer</h3>
            </div>
            <div class="panel-body">
            <h3><?php echo "We Recommend you to choose your career in the subkect tou scored most..";?></h3>
                <form>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <?php if($ExamType=="Intermediate") {?>
                            <div class="row">
                                <div class="col-md-12"><span>Engineering</span>
                                    <?php PrintProgressBar($Result["Engineering"]);?>
                                    <a class="btn btn-success" role="button" href="suggestions.php?category=Engineering">View Our Suggestions</a></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Medical</span>
                                    <?php PrintProgressBar($Result["Medical"]);?>

                                <a class="btn btn-success" href="suggestions.php?category=Medical">View Our Suggestions</a></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Law</span>
                                    <?php PrintProgressBar($Result["Law"]);?>
                                    <a class="btn btn-success"  href="suggestions.php?category=Law" >View Our Suggestions</a></div>
                            </div>
                        </li>
                         <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Arts</span>
                                    <?php PrintProgressBar($Result["Arts"]);?>
                                    <a class="btn btn-success"  href="suggestions.php?category=Arts">View Our Suggestions</a></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Commerce</span>
                                    <?php PrintProgressBar($Result["Commerce"]);?>
                                    <a class="btn btn-success" href="suggestions.php?category=Commerce">View Our Suggestions</a></div>
                            </div>
                        </li>
                          <?php } else { ?>
                         <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>PCM</span>
                                    <?php PrintProgressBar($Result["PCM"]);?>
                                    <!--<a class="btn btn-primary"  href="suggestions.php?category=PCM&Type=School" >View Our Suggestions</a>-->
                                    </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>PCB</span>
                                    <?php PrintProgressBar($Result["PCB"]);?>
                                    <!--<a class="btn btn-primary"  href="suggestions.php?category=PCB&Type=School" >View Our Suggestions</a>--></div>
                            </div>
                        </li>
                         <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Arts</span>
                                    <?php PrintProgressBar($Result["Arts"]);?>
                                    <!--<a class="btn btn-primary"  href="suggestions.php?category=Arts&Type=School">View Our Suggestions</a>--></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12"><span>Commerce</span>
                                    <?php PrintProgressBar($Result["Commerce"]);?>
                                    <!--<a class="btn btn-primary"  href="suggestions.php?category=Commerce&Type=School">View Our Suggestions</a>--></div>
                            </div>
                        </li>


                         <?php } ?>
                       
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>