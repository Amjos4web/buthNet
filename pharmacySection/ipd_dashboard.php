<?php 
session_start();
ob_start();
// error display configuration


if(!isset($_SESSION['emaill'])){
	header('location: ipd_login.php');
}
//This block grabs the whole list for viewing
$msg="";
$email= $_SESSION['emaill'];
include "dbconnect2.php";
$sql="SELECT * FROM `ipd_login` WHERE `emailAdd`='$email' LIMIT 1";
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


$dynamic_lists = "";
// $page = "";


// $page = $_GET['page'];
// if ($page == "" || $page == "1"){
	// $page1 = 0;
// } else {
	// $page1 = ($page*14)-14;
// }

$sql2 = "SELECT * FROM `ipd_pharm_req` ORDER BY date_added DESC LIMIT 30";
$check2 = mysqli_query($dbconnect, $sql2) or die (mysqli_error($dbconnect));
$resultCount2=mysqli_num_rows($check2); //count the out amount 

if($resultCount2>0){
	while($row=mysqli_fetch_array($check2)){
	$product_id=$row["id"];
	$product_name=$row["product_name"];
	$product_price=$row["unit_price"];
	$quantity_available=$row["quantity"];
	$category=$row["category"];
	$date_added=$row["date_added"];
	$drug_type=$row["drug_type"];
	$dynamic_lists .= "<tr>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $product_id . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $product_name . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $category . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $drug_type . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>N" . $product_price . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $quantity_available . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . $date_added . "</td>";
	$dynamic_lists .= "<td style='background-color:#CECECE; padding-left: 5px; font-family: Adobe Heiti Std R; font-size: 14px'>" . "<a href='ipd_products.php?product_id=$product_id' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>View Details</a></td>";
	$dynamic_lists .= "</tr>";
	
	}
	
}else{
$msg="<p style='color: #D8000C; background-color: #FFBABA; border-radius:.5em; width: 300px; border: 1px solid #D8D8D8; padding: 5px; border-radius: 5px; margin-left: auto; margin-right: auto; font-family: Arial; font-size: 11px; text-transform: uppercase; text-align: center; text-transform: uppercase'>There is no product in the store yet</p>";
}

?>
<!doctype html>
<html>
<link href="http://localhost/buth_net/pharmacySection/css/buth_net.css" rel="stylesheet" type="text/css">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" >
<title>Welcome Client</title>
<script src="js/jquery-1.12.3.min.js" type="text/javascript"></script>
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
	  <li><a href="index.php">Main Page</a></li><br>
      <li><a href="ipd_dashboard.php">Drugs</a></li><br>
	  <li><a href="ipd_payment_verification.php">Payment Verification</a></li><br>
      <li><a href="ipd_cart.php">Billing</a></li><br>
      <li><a href="logout.php">Logout</a></li><br>
    </ul>
	 <img src="images/drugs.png" width="170px" height="250px" style="margin-left: 20px" alt="Welcome To School of Nursing"><br><br>
	 <?php include_once "../new_bar.php"; ?>
      <!-- end .sidebar1 --></div>
     <div class="margin" id="content">
	  <div class="welcome_message">
	   <h1 style='text-align: center; font-family: tahoma; font-size: 16px; text-transform: uppercase; font-weight: bold; background-color: #000000; margin-top: -5px; color: #CECECE'>Welcome <?php echo $name."!"; ?> What would you like to do today?</h1>
	     <a href="ipd_cart.php"><img src="images/cart2.jpg" alt="My Cart" width="40px" height="40px" style="float: right; margin-right: 22px"></a><h2 style='margin-left: 0px; font-family: Calibri (Body); font-size: 22px; font-weight: bold; text-transform: uppercase; font-style: normal; color: #880000; text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15)'>Available Stocks</h2>
		<div class="search" style="float: right; margin-right: 20px">
		 <form action="ipd_search.php" method="post">
		 <input type="text" name="search" id="search" maxlength="88" placeholder="Search by name or category...">
		 <input type="submit" value="Search" name="searchbtn" id="searchbtn">
		 </form>
		</div>
	   </div><br>
	   <h1 class="page" style="color: #FFFFFF; font: 18px Arial, Helvetica, sans-serif;">IPD Pharmacy Section</h1>
	 <div id="product_form3">
	  <table width="760px" style="margin-left: auto; margin-right: auto" cellpadding="1" cellspacing="0" border="1">
	   <tr>
	    <td width="5%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>ID</b></td>
		<td width="18%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Name</b></td>
		<td width="17%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Category</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Type</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Selling Price</b></td>
		<td width="10%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Quantity Available</b></td>
		<td width="16%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Date Added</b></td>
		<td width="12%" style='background-color:#C5DFFA; font-family: arial black; text-align: center; font-size: 14px'><b>Drugs Detail</b></td>
		</tr>
		<?php echo $dynamic_lists; ?>
	    <?php
	    echo $msg;
	    ?>
		<!--tr>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>
		 <td>&nbsp;</td>Prof
		</tr-->
		</table><br>
		 </div>
		 <?php
		//  this is for counting page
		// $sql3 = "SELECT * FROM `products` ORDER BY date_added DESC";
		// $check3 = mysqli_query($dbconnect, $sql3) or die (mysqli_error($dbconnect));
		// $resultCount3=mysqli_num_rows($check3); //count the out amount 
        
		// $a = $resultCount3/14;
		// $a = ceil($a);
		   // for($b=1;$b<=$a;$b++)
		   // {
			   
		   // }
		 ?>
	   </div>
	   <!-- end .content --></div>
	  <!-- end .container --></div>
     <?php
      include_once "footer.php";
     ?>
</body>
</html>