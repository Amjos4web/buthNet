<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: copd_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `copd_login` WHERE `emailAdd`='$email' LIMIT 1";
$check = mysqli_query($dbconnect, $sql);
$resultCount=mysqli_num_rows($check); //count the out amount 
if($resultCount>0){
	while($row=mysqli_fetch_array($check)){
	$id=$row["id"];
	$password=$row["passWord"];
	$name=$row["first_name"];
	}
}else{
$msg="<p style'color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'You have no Information yet in the Database</p>";
}
?>
<?php
//list for receipt

$cartOutput = "";
$cartTotal = "";
	if(!isset($_SESSION['CartArray']) || count($_SESSION['CartArray']) < 1){
		$cartOutput = "<p style='color: red; text-align: center; font-weight: bold; font-size: 20px'>Your Billing Cart is empty</p>";
	} else {
		foreach ($_SESSION['CartArray'] as $each_item){
			$item_id = $each_item['item_id'];
			$sql2 = "SELECT * FROM `copd_pharm_req` WHERE `id`='$item_id' LIMIT 1";
			$check2 = mysqli_query($dbconnect, $sql2);
			while ($row2=mysqli_fetch_array($check2)){
				$product_name = $row2['product_name'];
				$product_price = $row2['unit_price'];
				$category=$row2["category"];
				
				$priceTotal = $product_price * $each_item['quantity'];
				$cartTotal = $priceTotal + $cartTotal;
				// dynamic table row assembly
				$cartOutput .= "<tr>";
				$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $item_id . "</td>";
				$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $product_name . "</td>";
				$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>" . $category . "</td>";
				$cartOutput .= "<td style='background-color:#CECECE; font-family: Adobe Heiti Std R; font-size: 14px'>N" . $product_price . "</td>";
				$cartOutput .= "</tr>";

			
				$cartTotal = $cartTotal;
				}
			}
		}	
?>
<?php					
$patient_name = $_POST['patient_name'];
$patient_name = preg_replace("#[^a-z.]#i", "",$_POST['patient_name']);
$hospital_no = $_POST['hospital_no'];
$payment_date = date('Y-m-d');
$voucher_paid_for = "Drugs";


if (empty($patient_name) == false)
{
	$sql7 = "SELECT * FROM `transactions` WHERE `hospital_no`='$hospital_no'";
	$query7 = mysqli_query($dbconnect, $sql7) or die (mysqli_error($dbconnect));
	$check8 = mysqli_num_rows($query7);
	
	$sql8 = "INSERT INTO `transactions` (`patient_name`,`hospital_no`,`total_amount`,`payment_date`,`staff_id`, `paid_for`) VALUES ('$patient_name', '$hospital_no', '$cartTotal', '$payment_date', '$name', '$voucher_paid_for')";
	$query8 = mysqli_query($dbconnect, $sql8) or die (mysqli_error($dbconnect));
	
	?><script type="text/javascript">
	alert ('Are you sure you want to continue?');
	</script><?php
	?><!doctype html>
	 <html>
	 <head>
	 <meta charset="utf-8">
	 <meta http-equiv="refresh" content="5;url=http://localhost/buth_net/pharmacySection/copd_receipts.php/" />
	 <title>Redirecting....</title>
	 </head>
	 <style>
		#continue_refresh p {
		-moz-box-shadow: 0px 10px 14px -7px #276873;
		-webkit-box-shadow: 0px 10px 14px -7px #276873;
		box-shadow: 0px 10px 14px -7px #276873;
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
		background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
		background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
		background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
		background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
		background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
		background-color:#599bb3;
		-moz-border-radius:8px;
		-webkit-border-radius:8px;
		border-radius:4px;
		display:inline-block;
		color:#ffffff;
		font-family:New Times Roman;
		font-size:28px;
		font-weight:bold;
		padding:5px;
		text-decoration:none;
		text-shadow:0px 1px 0px #3d768a;
		margin-top: 200px
		}
	 </style>
	 <body>
	 <div id="continue_refresh">
	 <center><p>Please wait... Your receipt will be ready in 5 seconds...</p></center>
	 <center><img src="../pharmacySection/images/sb-loading.gif" alt="Loading..." width="300px" height="300px"></center>
	 </div>
	 </body>
	 </html><?php
	 exit();
} else 
	?><script type="text/javascript">
	  alert ('Please enter the patient name');
	  window.location = "copd_cart.php";
	  </script><?php 
?>

