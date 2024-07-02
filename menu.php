<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand" href="index.php">Career Counseling</a><button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="index.php">Home</a></li>
                    <?php if(!isset($_SESSION["UID"])) {?>
                        <li role="presentation"><a href="login.php">Login</a></li>
                        <?php } ?>

                    <?php if(isset($_SESSION["UID"])) {?>
                        
                        <li role="presentation"><a href="profile.php">My Profile</a></li>
                        <?php if($_SESSION["UserType"]=="Admin") {?>
                            <li role="presentation"><a href="10questions.php">10th Questions</a></li>
                            <li role="presentation"><a href="12questions.php">12th Questions</a></li>
                            <li role="presentation"><a href="colleges.php">Colleges</a></li>
                        <?php } ?>
                        <?php if($_SESSION["UserType"]=="User") {?>
                             <?php if($_SESSION["EnrolledFor"]=="HighSchool"){ ?><li role="presentation"><a href="quicktest10.php">Quiz for 10</a></li><?php }?>
                            <?php if($_SESSION["EnrolledFor"]=="Intermediate"){ ?><li role="presentation"><a href="quicktest12.php">Quiz for 12</a></li><?php }?>
                            <li role="presentation"><a href="performance.php">Performence</a></li>
                        <?php }?>
                    <?php } ?>

                    
                   

                    <li role="presentation"><a href="feedback.php">FeedBack</a></li>
                    <li role="presentation"><a href="contactus.php">Contact us</a></li>
                    <?php if(isset($_SESSION["UID"])) {?><li role="presentation"><a href="assets/phpscript/logout.php">Logout</a></li><?php }?>

                </ul>
        </div>
        </div>
    </nav>