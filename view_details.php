<?php
include 'dbconn.php';

require_once('TCPDF-main/tcpdf.php');


// Retrieve the bill number 
if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer details
    $sql = "SELECT * FROM `customer_details` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $purchaseDetails = mysqli_fetch_assoc($result);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom Css -->
    <style>
		a{
			text-decoration: none !important;
		}
	</style>
	<link rel="stylesheet" href="assets/css/dash_style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
 
<section id="sidebar">
		<a href="dashboard.php" class="brand">
			<i class="fa fa-solid fa-hand-holding-dollar"></i>
			<span class="text">My Jwellery</span>
		</a>
		<ul class="side-menu top Dashboard">
			<li class="active">
				<a href="dashboard.php">
					<i class="fa fa-solid fa-house"></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="">
				<a href="new_bill.php">
				<i class="fa-solid fa fa-plus"></i>
					<span class="text">New Bill</span>
					
				</a>
				
			</li>
			<li>
				<a href="">
				<i class="fa-solid fa fa-money-bill-1"></i>
					<span class="text">Show Bill</span>
				</a>
			</li>
			
			<li>
				<a href="#">
                <i class="fa-solid fa fa-indian-rupee-sign"></i>
					<span class="text">Sales</span>
				</a>
			</li>
            
		</ul>

		
	</section>

	<!-- Left Sidebar End -->

    <!--  -->
	<section id="content">
		<!-- navbar end -->
		<nav>
			<a href="#" class="nav-link"></a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class="fa fa-solid fa-magnifying-glass"></i></button>
				</div>
			</form>
			
			
			
			<!-- profile -->
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-user"></i>
				
			</a>
			<ul class="dropdown-menu dropdown-menu-end">
                    
                  
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                </ul>
			
		</nav>
		<!-- navbar end  -->
        <main>
			
		<?php if (isset($purchaseDetails)) { ?>
<section class="container">
    <!-- Display purchase details here -->
    <h2>Customer Purchase Details for: <?php echo $purchaseDetails['name']; ?></h2>
	<!-- Customer details -->
    <p>Bill Number: <?php echo $purchaseDetails['customer_id']; ?></p>
    <p>Customer Name: <?php echo $purchaseDetails['name']; ?></p>
    <p>Date of Purchase: <?php echo $purchaseDetails['date']; ?></p>
    <p>Address<?php echo $purchaseDetails['address']; ?></p>
	<p>State<?php echo $purchaseDetails['address']; ?></p>


   <!-- product details -->


   <p>Product Description<?php echo $purchaseDetails['description']; ?></p>
    <p>Karet<?php echo $purchaseDetails['karet']; ?></p>
    <p>HSN Code<?php echo $purchaseDetails['hsncode']; ?></p>
	<p>Gross Weight(in gram.)<?php echo $purchaseDetails['gross_weight1']; ?></p>
	<p>Net Weight(in gram.)<?php echo $purchaseDetails['net_weight']; ?></p>
	<p>Rate (in Rs.)<?php echo $purchaseDetails['rate']; ?></p>
	<p>Labour Charge (in Rs.)<?php echo $purchaseDetails['labour_charge']; ?></p>
	
   <!-- bill details -->
   <p>Amount<?php echo $purchaseDetails['total_amount']; ?></p>
   <p>SGST Amount(1.5%)<?php echo $purchaseDetails['sgst_amount']; ?></p>
   <p>CGST Amount(1.5%)<?php echo $purchaseDetails['cgst_amount']; ?></p>
   <p>GST Amount(3%)<?php echo $purchaseDetails['gst_total']; ?></p>
   <p>Total Amount<?php echo $purchaseDetails['total_amount_after_taxes']; ?></p>

    <!-- ...Download btn -->
    <a href="generate_pdf.php?customer_id=<?php echo $purchaseDetails['customer_id']; ?>"
       class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
</section>
<?php } else { ?>
<section class="container">
    <p>No purchase details found for the provided bill number.</p>
</section>
<?php } ?>
		
		</main>

 <!-- Javascript -->
 <script src="script.js"></script>

<script src="https://kit.fontawesome.com/f2786c0b81.js" crossorigin="anonymous"></script>
</body>
</html>        













