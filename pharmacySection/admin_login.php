<?php
$msg = "";
if (isset($_POST['login'])){
	include "dbconnect2.php";
	$password = trim($_POST['passWord']);
	$email = trim($_POST['email']);
	$last_log_date = date('Y-m-d H:i:s');
	if (empty($email && $password) == false){
		$sql = "SELECT * FROM `admin` WHERE `admin_email`='$email' && `admin_password`='$password'";
		$check = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		$result = mysqli_num_rows($check);
		if ($result > 0){
			session_start();
			$_SESSION['emaill'] = $email;
			header('location: admin_dashboard.php');
			$sql = "UPDATE `admin` SET `last_log_date`='$last_log_date' WHERE `admin_email`='$email'";
			$check2 = mysqli_query($dbconnect, $sql) or die (mysqli_error($dbconnect));
		} else
		$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Error: Invalid password or email address</p>";
	} else
	$msg = "<p style='color: #880000; padding-left: 0px'><span class='successbtn'><img src='images/error.png' alt='error' width='22px' height='22px'></span>Error: Please enter your email and password to login</p>";

}
?>

<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Admin Login Page</title>
</head>
<body>
<?php
include_once "header.php";
?>
<div id="container">
  <div id="sidebar1"><br>
    <p class="subHeader">Menu</p>
    <ul id="navigation2">
<li class="page_title">Pharmacy Unit</li><br>
	  <li><a href="http://localhost/buth_net/index.php">Mainpage</a></li><br>
      <li><a href="admin_login.php">Admin Login</a></li><br>
	  <li><a href="pharmacy_store.php">Pharmacy Store</a></li><br>
      <li><a href="copd_login.php">COPD Login</a></li><br>
	  <li><a href="mopd_login.php">MOPD Login</a></li><br>
	  <li><a href="ipd_login.php">IPD Login</a></li><br>
	  <li><a href="ae_pharm_login.php">A and E Login</a></li><br>
      <li><a href="pead_pharm_login.php">MCH login</a></li><br>
    </ul>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="login_form">
	   <fieldset>
		 <legend>Admin Login Section</legend>
		  <form action="" method="post">
		  <?php
		   echo $msg;
		  ?>
		    <p style='padding-left: 12px; font-family: impact; font-size: 14px; text-style: italic; color: #880000'>This page is restricted for non admin users</p>
		   <label class="labelEmail"><span class='successbtn'><img src="images/personal.png" alt="email" width="22px" height="22px"></span>Email</label>
		    <p><input type="text" id="email" name="email" autofocus></p>
			<label class="labelEmail"><span class='successbtn'><img src="images/pass.ico" alt="email" width="22px" height="22px"></span>Password</label>
		    <p><input type="password" id="passkey" name="passWord"></p>
			<input type="submit" value="Login" name="login" id="login22">
			<input type="submit" value="Forgot Password" name="forgotpass" id="forgotpass2">
			  </form>
			 </fieldset>
		    </div>
			   <!-- end .content --></div>
			  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>