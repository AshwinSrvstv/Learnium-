<?php

{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
$UID=6;
//if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];
$User =$db->GetSingleRow("select * from users where UID=".$UID);

if(isset($_GET["delete"])){$db->NonQuery("delete from results where RID=".$_GET["delete"]);$_SESSION["Message"]="Record Deleted";}

$Records=$db->GetResult("SELECT * FROM results where UID=".$UID . " order by ExamType");

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
            <p>Past Performances</p>
            <footer>Test Results Records</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><span>Previous Records</span></div>
             <div class="panel-body">
                <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"]!=""){ PrintAlert($_SESSION["Message"],"Success"); $_SESSION["Message"]=""; } ?>
                 </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 63px;">Sno.</th>
                            <th>Quiz Date Time</th>
                            <?php if($User["EnrolledFor"]=="Intermediate"){?>
                            <th style="width: 150px;">Engineering</th>
                            <th style="width: 150px;">Medical</th>
                            <th style="width: 150px;">Law</th>
                            <th style="width: 150px;">Arts</th>
                            <th style="width: 150px;">Commerce</th>
                            <?php } else{ ?>
                             <th style="width: 150px;">PCM</th>
                            <th style="width: 150px;">PCB</th> 
                            <th style="width: 150px;">Arts</th>
                            <th style="width: 150px;">Commerce</th>
                            <th></th>
                            <?php } ?>
                           
                            <th style="width: 150px;">Actions</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0;
                                  if($Records) while($row=$Records->fetch_assoc()){?>
                                              
                        <tr>
                            <td><?php echo ++$count;?>.</td>
                            <?php if($row["ExamType"]=="Intermediate"){?>
                                <td><a href="testresult.php?RID=<?php echo $row['RID']; ?>"> <?php echo $row["TestDateTime"]; ?></a></td>
                            <?php }else {?>
                            <td>
                                <?php echo $row["TestDateTime"]; ?>
                            </td>


                            <?php }?>
                              <?php if($row["ExamType"]=="Intermediate"){?>
                            <td><?php PrintProgressBar($row["Engineering"]); ?></td>
                            <td><?php PrintProgressBar($row["Medical"]); ?></td>
                            <td><?php PrintProgressBar($row["Law"]); ?></td>
                               <?php } else{ ?>
                            <td><?php PrintProgressBar($row["PCM"]); ?></td>
                            <td><?php PrintProgressBar($row["PCB"]); ?></td>
                           <td></td>
                               <?php } ?>
                            <td><?php PrintProgressBar($row["Arts"]); ?></td>
                            <td><?php PrintProgressBar($row["Commerce"]); ?></td>
                           
                            <td><a class="btn btn-warning btn-block" href="performance.php?delete=<?php echo $row["RID"]; ?>"><strong>X </strong>Delete Record</a></td>
                        </tr>

                        <?php } if($Records->num_rows==0) { echo '<tr><td>'.PrintAlert("No Records Found","danger").'</td></tr>'; } ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer"><span>Panel Footer</span></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>