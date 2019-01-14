<?php

session_start();
require_once 'user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
    $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
    $id = base64_decode($_GET['id']);
    $code = $_GET['code'];

    $stmt = $user->runQuery("SELECT * FROM Banks WHERE BankId=:uid AND tokenCode=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 1)
    {
        if(isset($_POST['btn-reset-pass']))
        {
            $pass = $_POST['pass'];
            $cpass = $_POST['confirm-pass'];

            if($cpass!==$pass)
            {
                $msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
            }
            else
            {
                $password = md5($cpass);
                $stmt = $user->runQuery("UPDATE Banks SET Passsword=:upass WHERE BankId=:uid");
                $stmt->execute(array(":upass"=>$password,":uid"=>$rows['BankId']));

                $msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed.
						</div>";
                header("refresh:5;index.php");
            }
        }
    }
    else
    {
        $msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
				</div>";

    }


}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>

</head>
<body id="login">



<?php

if($user->is_logged_in())
{

    $id = base64_encode($_SESSION['userSession']);
    $code = $_SESSION['userToken'];
    $restUrl = "resetpass.php?id=".$id."&code=".$code;
    $bcode =  $_SESSION['userName'];

    ?>

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
                            <a href="http://geoauth.info/2018/02/12/api-doc/">Api Doc</a>
                        </li>


                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>


    <?php

}

?>










< class="container">
    <div class='alert alert-success'>
        <strong>Hello !</strong>  <?php echo $rows['userName'] ?> you are here to reset your forgetton password.
    </div>
    <form class="form-signin" method="post">
        <h3 class="form-signin-heading">Password Reset.</h3><hr />
        <?php
        if(isset($msg))
        {
            echo $msg;
        }
        ?>
        <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
        <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
        <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Reset Your Password</button>

    </form>

</body>>
</html>