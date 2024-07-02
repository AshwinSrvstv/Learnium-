
<?PHP
//f(session_status()==1)
{session_start();}

$Name=$Mobile=$Email=$PWD=$Address="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');


$err=$CID=$EnrolledFor="";
if (isset($_POST["Name"])) {
    
    $Name=$_POST["Name"];
    $Mobile=$_POST["Mobile"];
    $Email=$_POST["Email"];
    $PWD=$_POST["PWD"];
    $REPWD=$_POST["REPWD"];
    $EnrolledFor=$_POST["EnrolledFor"];


    //$File = $_FILES["Image"];
    //$DocumentName = $_POST["DocumentName"];
    //$file_name = $_FILES['Image']['name']; 
    
    //$file_size =$_FILES['Image']['size'];
    //$file_tmp =$_FILES['Image']['tmp_name'];
    //$file_type=$_FILES['Image']['type'];
    //$file_ext=strtolower(end(explode('.',$_FILES['Image']['name'])));

    
    if($PWD!=$REPWD){$err="Password MisMatch";}
    else if($db->ScalerQuery("select count(*) from users where Mobile='".$Mobile."'")=="1")  {$err="Mobile Already Registered.";}
    else if($db->ScalerQuery("select count(*) from users where Email='".$Email."'")=="1")  {$err="Email Already Registered.";}
    else{
        $sql="INSERT INTO users(`UserName`,`Mobile`,PWD,RegisteredOn,Email,Address,EnrolledFor) VALUES('".$Name."','".$Mobile."','".$PWD."',NOW(),'".$Email."','".$Address."','".$EnrolledFor."');";
        if($db->NonQuery($sql))
        {
            $_SESSION["Message"]="Success-#-Registration Successful. Login Now.";
            $_SESSION["UID"]=$db->ScalerQuery("select MAX(UID) from users");
            $_SESSION["Name"]=$_POST["Name"];
            $_SESSION["Mobile"]=$_POST["Mobile"];
            $_SESSION["Email"]=$_POST["Email"];
            $_SESSION["PWD"]=$_POST["PWD"];
            header("location: profile.php"); 
            return;           

        }

       
        
       
    }
   
}
    


//$ProfileTypeList = SelectOptionsFormArray(explode(",","Student,College Representative"),$Type);

//$sql="select CID,Name from colleges";
//$result = $db->GetResult($sql);
//$CollegeList=SelectOptionsWithValues($result,$CID);
$EnrollmentType = SelectOptionsFormArray(array("HighSchool","Intermediate"),$EnrolledFor);

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
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left"><a><img class="media-object" src="assets/img/add_female_user.png" width="80"></a></div>
                        <div class="media-body">
                            <blockquote>
                                <p>Create Profile</p>
                                <footer>Career Guide</footer>
                            </blockquote>
                        </div>
                    </div>
                    <hr>
                   <form method="post">
                            <?php if($err!="")PrintAlert($err,"warning");?>

                <div class="form-group">
                    <input class="form-control" type="text" name="Name" required placeholder="Name" pattern="[a-zA-Z .-]{2,25}" value="<?php echo $Name; ?>"></div>
                <div class="form-group">
                    <input class="form-control" type="email" name="Email" required placeholder="Email" value="<?php echo $Email; ?>"></div>
                <div class="form-group">
                    <input class="form-control" type="text" name="Mobile" pattern="[6789]{1}[0-9]{9}" required placeholder="Mobile" value="<?php echo $Mobile; ?>"></div>
                
                <div class="form-group">
                    <input class="form-control" type="password" name="PWD" required placeholder="Password"></div>
                <div class="form-group">
                    <input class="form-control" type="password" name="REPWD" required placeholder="Password (repeat)"></div>
                <div class="form-group">
                   <select class="form-control" name="EnrolledFor"><?php echo $EnrollmentType;?></select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Sign Up</button></div>
                <a href="login.php" class="already">You already have an account? Login here.</a>
            </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left"><a><img class="media-object" src="assets/img/info.png" width="80"></a></div>
                        <div class="media-body">
                            <blockquote>
                                <p>How it works</p>
                                <footer>Features &amp; Benefits...</footer>
                            </blockquote>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>1. </strong> Complete Our Registration process.</td>
                                </tr>
                                <tr>
                                    <td><strong>2. </strong>Take a Quick Test</td>
                                </tr>
                                <tr>
                                    <td><strong>3. </strong>Review our Suggestion about Colleges</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>