<?php

{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');  
if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];


if(isset($_GET["delete"])){$db->NonQuery("delete from colleges where CID=".$_GET["delete"]); header("location: colleges.php"); return;}

$Colleges=$db->GetResult("SELECT * FROM colleges");

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
    <?php include ("menu.php");?>

    <div class="container">
        <blockquote>
            <p>List of Colleges</p>
            <footer>This recommendation is based on your test score</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-primary" role="button" href="collegeinfo.php"><strong>+ Add New College</strong></a>

            </div>
            <div class="panel-body">
                <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"]!=""){ PrintAlert($_SESSION["Message"],"Success"); $_SESSION["Message"]=""; } ?>



                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>College Name</th>
                                <th>Contact</th>
                                <th>Website</th>
                                <th>Address</th>
                                <th style="width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=0;
                                  if($Colleges) while($row=$Colleges->fetch_assoc()){?>
                       
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><a href="collegeinfo.php?cid=<?php echo $row["CID"];?>"><?php echo $row["CollegeName"]; ?></a></td>
                                <td><?php echo $row["Contact"]; ?></td>
                                <td><?php echo $row["Website"]; ?></td>
                                <td><?php echo $row["Address"]; ?></td>

                                <td>
                                    <a  class="btn btn-warning" href="colleges.php?delete=<?php echo $row["CID"];?>" ><strong>X Delete Record</strong></a></td>
                            </tr>
                            <?php } ?>



                        </tbody>
                    </table>
                </div>

            </div>
            <div class="panel-footer"><span>Panel Footer</span></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
