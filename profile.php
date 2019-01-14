<?php
session_start();
require_once 'user.php';

$reg_user = new USER();

if(!$reg_user->is_logged_in())
{
    $reg_user->redirect('index.php');
}


$stmt = $reg_user->runQuery("SELECT * FROM banks WHERE BankId=:email_id");
$stmt->execute(array(":email_id"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$Bname = $row['BankName'];
$Bcode = $row['BankCode'];
$Bemail = $row['Email'];
$id = base64_encode($_SESSION['userSession']);
$code = $_SESSION['userToken'];
$restUrl = "resetpass.php?id=".$id."&code=".$code;
$bcode =  $_SESSION['userName'];






if(isset($_POST['btn-signup']))
{
    $bankname = trim($_POST['txtbankname']);
    $bankcode = trim($_POST['txtbankcode']);

    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);


    $stmt = $reg_user->runQuery("SELECT * FROM Banks WHERE Email=:email_id AND BankId!=:uid");
    $stmt->execute(array(":email_id"=>$email,":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);



    if($stmt->rowCount() > 0)
    {
        $msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
    }
    else
    {
        if($reg_user->update($bankname,$bankcode,$email,$upass,$_SESSION['userSession']))
        {
            $id = $_SESSION['userSession'];
            $key = base64_encode($id);
            $id = $key;
            $code = $_SESSION['userToken'];
            $message = "					
						Hello $bankname,
						<br /><br />
						Welcome to Besafe!<br/>
						To complete your modification  please , just click following link<br/>
						<br /><br />
						<a href='http://admin.geoauth.info/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";

            $subject = "Confirm Modification";

            $reg_user->send_mail($email,$message,$subject);
            $msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
        }
        else
        {
            echo "sorry , Query could no execute...";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile </title>

</head>
<body id="login">


<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="http://admin.geoauth.info">GeoAuth</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
                            <?php echo $bcode; ?> <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">


                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="<?php echo $restUrl; ?>">Change Password</a></li>



                            <li>
                                <a tabindex="-1" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="active">
                        <a href="http://admin.geoauth.info">Transaction Log</a>
                    </li>
                    <li>
                        <a href="error.php">Error Log</a>
                    </li>
                    <li>
                        <a href="">Api Doc</a>
                    </li>


                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>



<div class="container">

    <?php if(isset($msg)) echo $msg;  ?>
    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Profile</h2><hr />
        <?php
        if(isset($_GET['error']))
        {
            ?>
            <div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong>
            </div>
            <?php
        }

        ?>
        <input type="text" class="input-block-level" value="<?php echo $_SESSION['ApiKey']; ?>" disabled />


        <input type="text" class="input-block-level" placeholder="Bank Name" value="<?php echo $Bname; ?>" name="txtbankname" required />
        <input type="text" class="input-block-level" placeholder="Bank Code" value="<?php echo $Bcode; ?>" name="txtbankcode" required />
        <input type="email" class="input-block-level" placeholder="Email address" value="<?php echo $Bemail; ?>"name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtpass" required />
        <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Update</button>




    </form>

</body>
</html>