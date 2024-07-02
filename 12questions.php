<?php

{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');  
if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];


if(isset($_GET["delete"])){$db->NonQuery("delete from questions where QID=".$_GET["delete"]); $_SESSION["Message"]="Question Deleted Successfully."; header("location: questions.php"); return;}

$Questions=$db->GetResult("SELECT * FROM questions where ExamType='Intermediate'");

?><html>

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
            <p>List of Questions</p>
            <footer>Correct Answer is Displayed in on Color</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="btn btn-primary" role="button" href="12questioninfo.php?qid=0"><strong>+ Add New Question</strong></a></div>
            <div class="table-responsive">
                <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"]!=""){ PrintAlert($_SESSION["Message"],"Success"); $_SESSION["Message"]=""; } ?>
                <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"]!=""){ PrintAlert($_SESSION["Message"],"Success"); $_SESSION["Message"]=""; } ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Question</th>
                            <th>Option 1</th>
                            <th><strong>Option 2</strong><br></th>
                            <th><strong>Option 3</strong><br></th>
                            <th><strong>Option 4</strong><br></th>
                            <th><strong>Category</strong><br></th>
                            <th style="width: 202px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $count=0;
                               if($Questions) while($row=$Questions->fetch_assoc()){?>
                       
                        <tr>
                            <td><?php echo ++$count; ?></td>
                            <td><?php echo $row["Question"]; ?></td>
                            <td <?php if( $row["Option1"]==$row["CorrectAnswer"]) echo 'class="text-primary"'; ?>><?php echo $row["Option1"]; ?></td>
                            <td <?php if( $row["Option2"]==$row["CorrectAnswer"]) echo 'class="text-primary"'; ?>><?php echo $row["Option2"]; ?></td>
                            <td <?php if( $row["Option3"]==$row["CorrectAnswer"]) echo 'class="text-primary"'; ?>><?php echo $row["Option3"]; ?></td>
                            <td <?php if( $row["Option4"]==$row["CorrectAnswer"]) echo 'class="text-primary"'; ?>><?php echo $row["Option4"]; ?></td>
                            <td><?php echo $row["Category"]; ?></td>
                            <td>
                                <div class="btn-group" role="group"><a class="btn btn-primary" href="12questioninfo.php?qid=<?php echo $row["QID"]; ?>">Edit Question</a>
                                    <a class="btn btn-warning" href="12questions.php?delete=<?php echo $row["QID"];?>" type="button">Delete</a></div>
                            </td>
                        </tr><?php } ?>
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