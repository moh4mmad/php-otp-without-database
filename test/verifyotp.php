<?php

require_once '../src/otp.class.php';
session_start();
if (empty($_SESSION['hash']))
{
    header("Location: index.php"); 
    exit();
}
if (isset($_POST["otp"])) {
    $otp = new Sakib\OTP;
    $email = $_SESSION['email'];
    $hash = $_SESSION['hash'];
    $code = $_POST['otp'];
    
    $hash = $otp->VerifyTOP($email,$code,$hash);
    
    if($hash == TRUE)
    {
        $success = true;
        session_destroy();
    }
    else
    {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>OTP Verification without Database</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="" method="post">
        <h3 style="font-size: 20px;" class="text-center">OTP Verification without DB</h3> 
        <?php if(isset($error)) {?>
        <div class="alert alert-danger" role="alert"> Verification failed! </div>
        <?php } ?>
        
        <?php if(isset($success)) {?>
        <div class="alert alert-success" role="alert"> Verification success! </div>
        <?php } ?>
        
        <div class="form-group">
            <input type="text" name="otp" class="form-control" placeholder="OTP" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
