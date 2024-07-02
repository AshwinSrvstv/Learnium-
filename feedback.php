<?php

session_start();  
include('assets/database/DBMySql.php'); $DB=new DBMySql;
include('assets/phpscript/FormatedOutput.php');


if(isset($_GET["delete"])){$DB->NonQuery("delete from feedbacks where fID=".$_GET["delete"]);$_SESSION["Message"]="success -#- Feedback Deleted."; }

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    $Name=$_POST["Name"];
    $Email=$_POST["Email"];
    $Message=$_POST["Message"];

    $sql="INSERT INTO `feedbacks`(`FeedBack`,`Name`,`CreatedOn`,`Email`) VALUES('".$Message."','".$Name."',NOW(),'".$Email."');";
    if( $DB->NonQuery($sql) ){$_SESSION["Message"]="success -#- Your Message has been submitted Successfully"; header("Location: feedback.php");return;}
}
$result = $DB->GetResult("Select * from feedbacks");
$IsAdmin=isset($_SESSION["UserType"]) && $_SESSION["UserType"]=="Admin";
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Counseling</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <script>
        var Show = true;
        function Toggle()
        {
            Show = !Show;
            $("#FeedbackForm").attr('hidden', Show);
           
        }
    </script>
</head>

<body>
        <?php include ("menu.php");?>

   <div class="container">
    <h3 style="margin-top: 0px;"><button onclick="Toggle()" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button> Queries And Feedbacks</h3>
</div>
    <hr />      
    <div class="container">
        <?PHP if(isset($_SESSION["Message"])){ PrintSmartAlert($_SESSION["Message"]);$_SESSION["Message"]=""; } ?>
    </div>    
    <div class="container" id="FeedbackForm" hidden>
        <div class="col-md-6 col-md-push-3">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Feed Back / Contact Us via Email</h3></div>
                <div class="panel-body">
                    <form action="feedback.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <h4 class="text-center"><img src="assets/img/add_female_user.png" width="75" height="75"> We Welcome Your Suggestions</h4></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <input class="form-control" type="text" name="Name" placeholder="Enter your Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p> </p>
                                <input class="form-control" type="email" name="Email" placeholder="Enter your Email ID">
                            </div>
                            <div class="col-md-12">
                                <p> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" rows="5" name="Message" placeholder="Enter your Query"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <p> </p>
                                <button class="btn btn-success btn-block" type="submit">Submit Your Queries</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <?php  {
            if($result)while($row=$result->fetch_assoc()){?>
    <div class="container">
              <?PHP if(isset($_SESSION["Message"])){ PrintSmartAlert($_SESSION["Message"]);$_SESSION["Message"]=""; } ?>

        <div class="row">
            <div class="col-md-12">

                <div class="media" style="min-height:120px">
                    <div class="media-left"><a><img class="media-object" src="assets/img/male_user_comment.png" style="width: 80px;" /></a></div>
                    <div class="media-body">
                        <h5 class="media-heading"><?PHP echo $row["Name"]; ?></h5>
                        <p><?PHP echo $row["Feedback"]; ?></p>
                        <p><strong>- <?PHP echo $row["CreatedOn"]; ?></strong></p>
                        <?php if($IsAdmin){?> <a class="btn btn-danger" role="button" href="feedback.php?delete=<?php echo $row["FID"];?>"><strong>Delete this Feedback</strong></a><?php }?>
                    </div>
                </div>
                <hr />

                
            </div>
        </div>
    </div>
    <?PHP }}?>
    

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>