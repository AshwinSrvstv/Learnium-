<?php

{session_start();}

$Name=$Mobile=$Contact=$CollegeName=$Description=$SelectedOption="";
$Question=$Option1=$Option2=$Option3=$Option4=$Category="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');
$QID="0";
if(isset($_GET["qid"])){$QID=$_GET["qid"];}

if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];
if(isset($_POST["QID"]))
{
    $QID=$_POST["QID"];

    $Question=$_POST["Question"];
    $Option1=$_POST["Option1"];
    $Option2=$_POST["Option2"];
    $Option3=$_POST["Option3"];
    $Option4=$_POST["Option4"];
    $Category=$_POST["Category"];
    $CorrectAnswer=$_POST["CorrectAnswer"];
    if($CorrectAnswer=="Option1")$CorrectAnswer= $Option1;
    if($CorrectAnswer=="Option2")$CorrectAnswer= $Option2;
    if($CorrectAnswer=="Option3")$CorrectAnswer= $Option3;
    if($CorrectAnswer=="Option4")$CorrectAnswer= $Option4;





    //$File = $_FILES["Image"];
    //$file_name = $_FILES['Image']['name'];
    //$file_size =$_FILES['Image']['size'];
    //$file_tmp =$_FILES['Image']['tmp_name'];
    //$file_type=$_FILES['Image']['type'];
    //$file_ext=strtolower(end(explode('.',$_FILES['Image']['name'])));
    //if($file_ext != "" && $file_ext!="jpg"){$err="Invalid Image Selected";}
    //else
    if($QID=="0")
    {
        $db->NonQuery("INSERT INTO `questions`(`Question`,`Option1`,`Option2`,`Option3`,`Option4`,`CorrectAnswer`,`Category`,`ExamType`) Values('".$Question."','".$Option1."','".$Option2."','".$Option3."','".$Option4."','".$CorrectAnswer."','".$Category."','HighSchool');");
        $_SESSION["Message"]="Question Added Successfully.";
        //$CID=$db->ScalerQuery("select max(CID) from colleges");
        //$target_file = "assets/img/colleges/" .$CID .".jpg";
        //if($file_name!=null || $file_name!="")move_uploaded_file($file_tmp,$target_file);

        header("location: 10questions.php");return;
    }
    else
    {
        $db->NonQuery("UPDATE questions set `Question`='".$Question."',`Option1`='".$Option1."',`Option2`='".$Option2."',`Option3`='".$Option3."',`Option4`='".$Option4."',CorrectAnswer='".$CorrectAnswer."', Category='".$Category."' where QID=".$QID);
        $_SESSION["Message"]="Question Info Updated Successfully.";
        //$target_file = "assets/img/colleges/" .$CID .".jpg";
        //if($file_name!=null || $file_name!="")move_uploaded_file($file_tmp,$target_file);
        header("location: 10questions.php");return;
    }
}


$QuestionRow=null;

//if(!isset($_SESSION["Mobile"])){header("location: profile.php"); return;}
if($QID!="0"){
    $QuestionRow=$db->GetSingleRow("Select * from questions where QID=".$QID);
    $Question=$QuestionRow["Question"];
    $Option1=$QuestionRow["Option1"];
    $Option2=$QuestionRow["Option2"];
    $Option3=$QuestionRow["Option3"];
    $Option4=$QuestionRow["Option4"];
    $Category=$QuestionRow["Category"];
    $CorrectAnswer=$QuestionRow["CorrectAnswer"];
    $SelectedOption="Option1";
    if($CorrectAnswer==$Option2)$SelectedOption="Option2";
    if($CorrectAnswer==$Option3)$SelectedOption="Option3";
    if($CorrectAnswer==$Option4)$SelectedOption="Option4";

}
$OptionList=SelectOptionsFormArray(array("Option1","Option2","Option3","Option4"),$SelectedOption);
$result =$db->GetResult("Select CategoryName from categories");
$CategoryList= SelectOptionsFormArray(array("PCM","PCB","COMMERCE","ARTS"),$Category);

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
            <p>Add | Update New Question</p>
            <footer>This recommendation is based on your test score</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><span>Question Info</span></div>
            <form method="post">
                <input type="hidden" name="QID" value="<?php echo $QID;?>"
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td rowspan="10" style="width: 270px;"><a href="assets/img/Monument.png"><img src="assets/img/27-270147_question-mark-clip-art-tiny-clipart-question-mark.png" width="250px"></a></td>
                                <td><strong>Category</strong></td>
                                <td><select name="Category" class="form-control"><?php echo $CategoryList;?></select></td>
                            </tr>
                            <tr>
                                <td style="width: 213px;"><strong>Question</strong><br></td>
                                <td><textarea class="form-control" rows="3" name="Question" required="" placeholder="Enter Question Here"><?php echo $Question; ?></textarea></td>
                            </tr>
                            <tr>
                                <td><strong>Option 1</strong></td>
                                <td><input class="form-control" type="text" value="<?php echo $Option1; ?>" name="Option1" required="" pattern="[a-zA-Z0-9 .,+_()#!@-]{2,50}"></td>
                            </tr>
                            <tr>
                                <td><strong>Option 2</strong></td>
                                <td><input class="form-control" type="text" name="Option2" required value="<?php echo $Option2; ?>" pattern="[a-zA-Z0-9 .,+_()#!@-]{2,50}"></td>
                            </tr>
                            <tr>
                                <td><strong>Option 3</strong></td>
                                <td><input class="form-control" type="text" name="Option3" required value="<?php echo $Option3; ?>" pattern="[a-zA-Z0-9 .,+_()#!@-]{2,50}"></td>
                            </tr>
                            <tr>
                                <td><strong>Option 4</strong></td>
                                <td><input class="form-control" type="text" name="Option4" required value="<?php echo $Option4; ?>" pattern="[a-zA-Z0-9 .,+_()#!@-]{2,50}"></td>
                            </tr>
                            <tr>
                                <td><strong>Correct Answer</strong></td>
                                <td><select class="form-control" name="CorrectAnswer" required=""><?php echo $OptionList;?></select></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="btn btn-success btn-block" type="submit">Update Information</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="panel-footer"><span>Add | Update Question&nbsp;</span></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>