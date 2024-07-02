<?php

{session_start();}

$Name=$Mobile=$Contact=$CollegeName=$Description=$Address=$Website=$err="";
include('assets/Database/DBMySql.php'); $db=new DBMySql;
include('assets/phpscript/FormatedOutput.php');
include('assets/phpscript/sms.php');
$CID="0";
if(isset($_GET["cid"])){$CID=$_GET["cid"];}

if(!isset($_SESSION["UID"])){header("location: login.php"); return;}
$UID=$_SESSION["UID"];
if(isset($_POST["CollegeName"]))
{
    $CID=$_POST["CID"];

    $CollegeName=$_POST["CollegeName"];
    $Contact=$_POST["Contact"];
    $Description=$_POST["Description"];
    $Category=$_POST["Category"];
    $Website=$_POST["Website"];
    $Address=$_POST["Address"];

    $File = $_FILES["Image"];
    $file_name = $_FILES['Image']['name'];
    $file_size =$_FILES['Image']['size'];
    $file_tmp =$_FILES['Image']['tmp_name'];
    $file_type=$_FILES['Image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['Image']['name'])));
    if($file_ext != "" && $file_ext!="jpg"){$err="Invalid Image Selected";}
    else if($CID=="0")
    {
        $db->NonQuery("INSERT INTO colleges(`CollegeName`,`Contact`,`Website`,`Address`,`Description`,`UID`,Category) VALUES('".$CollegeName."','".$Contact."','".$Website."','".$Address."','".$Description."',".$UID.",'".$Category."')");
        $_SESSION["Message"]="College Added Successfully.";
        $CID=$db->ScalerQuery("select max(CID) from colleges");
        $target_file = "assets/img/colleges/" .$CID .".jpg";
        if($file_name!=null || $file_name!="")move_uploaded_file($file_tmp,$target_file);
        $_SESSION["Message"]="College Info Added Successfully.";

        header("location: colleges.php");return;
    }
    else
    {
        $db->NonQuery("UPDATE colleges set `CollegeName`='".$CollegeName."',`Contact`='".$Contact."',`Website`='".$Website."',`Address`='".$Address."',`Description`='".$Description."',Category='".$Category."' where CID=".$CID);
        $_SESSION["Message"]="College Info Updated Successfully.";
        $target_file = "assets/img/colleges/" .$CID .".jpg";
        if($file_name!=null || $file_name!="")move_uploaded_file($file_tmp,$target_file);
        $_SESSION["Message"]="College Info Updated Successfully.";
        header("location: colleges.php");return;
    }
}


$CollegeRow=null;

//if(!isset($_SESSION["Mobile"])){header("location: profile.php"); return;}
if($CID!="0"){
    $CollegeRow=$db->GetSingleRow("Select * from colleges where CID=".$CID);
    $CollegeName=$CollegeRow["CollegeName"];
    $Contact=$CollegeRow["Contact"];
    $Website=$CollegeRow["Website"];
    $Contact=$CollegeRow["Contact"];
    $Address=$CollegeRow["Address"];

    $Description=$CollegeRow["Description"];
}
$result =$db->GetResult("Select CategoryName from categories");
$CategoryList=SelectOptionsFormResult($result,"");

$ReadOnly = $_SESSION["UserType"]!="Admin";

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
            <p>Add | Update New College</p>
            <footer>This recommendation is based on your test score</footer>
        </blockquote>
    </div>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><span>College Info</span></div>
            <div class="panel-body">
            <?php PrintAlert($err,"warning");?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="CID" value="<?php echo $CID;?>" />
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td rowspan="10" style="width: 270px;">
                                    <a href="assets/img/colleges/<?php echo $CID;  ?>.jpg"><?php PrintImage("assets/img/colleges/".$CID.".jpg","assets/img/Monument.png",270,270);?></a>
                                    </td>
                                <td style="width: 213px;"><strong>College Name</strong><br></td>
                                <td>
<input class="form-control" type="text" oninvalid="this.setCustomValidity('Enter College Name Here')" oninput="this.setCustomValidity('')" name="CollegeName" required value="<?php echo $CollegeName ?>" <?php if($ReadOnly) echo 'readonly' ; ?>  /></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong><br></td>
                                <td>
<input class="form-control" type="text" name="Address" required value="<?php echo $Address ?>" <?php if($ReadOnly) echo 'readonly' ; ?> /></td>
                            </tr>
                            <tr>
                                <td><strong>Contact</strong><br></td>
                                <td>
<input class="form-control" type="text" name="Contact" required value="<?php echo $Contact ?>" maxlength="10"<?php if($ReadOnly) echo 'readonly' ; ?> /></td>
                            </tr>
                            <tr>
                                <td><strong>WebSite</strong><br></td>
                                <td>
<input class="form-control" type="url" name="Website" required value="<?php echo $Website ?>" <?php if($ReadOnly) echo 'readonly' ; ?>  /></td>
                            </tr>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td>
<input class="form-control" type="text" name="Description" required value="<?php echo $Description ?>" <?php if($ReadOnly) echo 'readonly' ; ?>  /></td>
                            </tr>
                             <tr>
                                <td><strong>Category</strong></td>
                                <td><select class="form-control" name="Category" required <?php if($ReadOnly) echo 'readonly' ; ?> ><?php echo $CategoryList ?></select></td>
                            </tr>
                            <?php if(!$ReadOnly){?>
                            <tr>
                                <td><strong>Image</strong></td>
                                <td><input type="file" name="Image" multiple=""></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="btn btn-success btn-block" type="submit">Update Information</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
                </div>
            <div class="panel-footer"><span>Panel Footer</span></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>