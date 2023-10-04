<?php
include 'dbconn.php';

// Retrieve the bill number (if needed)
if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer details (if needed)
    $sql = "SELECT * FROM `new_customer_details` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $customerDetails = mysqli_fetch_assoc($result);

    // Fetch product details (if needed)
    $sql = "SELECT * FROM `product_details` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $productDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Fetch final bill details (if needed)
    $sql = "SELECT * FROM `final_bill` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $finalBillDetails = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice Bill</title>
    <!-- Include Bootstrap CSS for styling -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" -->
    <!-- integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <style>
    /* Define additional custom CSS styles here */
    /* Example: .my-custom-class { color: red; } */

    /* Center the title and address */
    body {
  margin: 0;
  padding: 0;
  font-family: "Helvetica", sans-serif;
}

    /* Style the invoice title */
    .invoice-title {
        background: #3c7cc9;
        font-size: 20px;
        margin-top: -31px;
        font-weight: bold;
    }

    .heading{
        font-family: 'Brush Script MT', cursive;
    }

    /* Style the tables */
    table {
        border-collapse: collapse;
        font-size: 15px;
        /* Collapse borders into a single border */
    }

    thead {
        background: #3c7cc9;
        color: white;
    }

    th,
    td {
        border: 1px solid #000;
        /* Add a 1px solid black border to cells */
        padding: 8px;
        /* Add padding for better spacing */
    }

    .bold-text {
        font-weight: bold;
    }

    .half-width {
        width: 350px;
    }

    .bank_details p {
        margin: 0;
        padding: 3px;
    }

    /* Add this CSS code to your styles in the template file */
.footer p{
    text-align: center:
    background: red;

    position: fixed;
    bottom: -10px;
    width: 100%;
}

    </style>
</head>

<body>
    <div class="container">

        <center>
            <h4 class="invoice-title">Tax Invoice</h4>
            <h1 class="heading">Shreerang Jewellers</h1>
            < <p>Address: Sarafa Line, Main Road, Yavatmal - 445001</p>
                <p class="bold-text">Mobile No.: 8482855422 &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; 
                 
                    GSTIN: 27EYUPS6827P1ZY &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; Date : <?php echo $customerDetails['date']; ?></p>
                <hr>
        </center>

        <!-- Customer Purchase Details -->
        <!-- <h3 class="">Customer Purchase Details:</h3> -->

        <p><strong>Bill Number:</strong> <?php echo $customerDetails['customer_id']; ?></p>
        <p><strong>Customer Name:</strong> <?php echo $customerDetails['name']; ?></p>
        <p><strong>Date of Purchase:</strong> <?php echo $customerDetails['date']; ?></p>
        <p><strong>Address:</strong> <?php echo $customerDetails['address']; ?></p>

        <p><strong>State:</strong> <?php echo $customerDetails['state']; ?></p>
        <hr>

        <!-- Products Purchased -->
        <h3 class="">Products Purchased:</h3>
        <table class="table">
            <thead class="">
                <tr>
                    <th>Sr. No</th>
                    <th>Product Name</th>
                    <th>Net Weight (gms)</th>
                    <th>Gross Weight (gms)</th>
                    <th>HSN Code</th>
                    <th>Rate (Rs.)</th>
                    <th>Labour Charge (Rs.)</th>
                    <th>Total Amount (in Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($productDetails as $product) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo number_format($product['net_weight'], 2); ?></td>
                    <td><?php echo number_format($product['gross_weight'], 2); ?></td>
                    <td><?php echo $product['hsncode']; ?></td>
                    <td><?php echo $product['rate']; ?></td>
                    <td><?php echo $product['labour_charge']; ?></td>
                    <td><?php echo $product['total_amount']; ?></td>
                </tr>
                <?php 
                    $count++;
                } ?>
            </tbody>
        </table>


        <!-- Final Bill Details -->
        <h3 class="mt-4">Final Bill Details:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th class="half-width">Bank Details</th>
                    <th>Description</th>
                    <th>Amount (in Rs.)</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td rowspan="5" class="bank_details">
                        <p>THE WASHIM URBAN CO-OPERATIVE BANK</p>
                        <p>ACCOUNT NUMBER : 89565982641</p>
                        <p>BANK IFSC COCE : MAHB0000639</p>
                        <p>PAN NO. : FFGHG9787G</p>


                    </td>
                    <td>Total Amount:</td>
                    <td>Rs. <?php echo $finalBillDetails['total_amount']; ?></td>
                </tr>
                <tr>
                    <td>GST Amount (3%):</td>
                    <td>Rs. <?php echo $finalBillDetails['gst_total']; ?></td>
                </tr>
                <tr>
                    <td>SGST Amount (1.5%):</td>
                    <td>Rs. <?php echo $finalBillDetails['sgst_amount']; ?></td>
                </tr>
                <tr>
                    <td>CGST Amount (1.5%):</td>
                    <td>Rs. <?php echo $finalBillDetails['cgst_amount']; ?></td>
                </tr>
                
                <tr>
                    <td>Total Amount after Taxes:</td>
                    <td>Rs. <?php echo $finalBillDetails['total_amount_after_taxes']; ?></td>
                </tr>
            </tbody>
        </table>
<br><br><br>
        <!-- Signatures -->
     
                <p><strong>Customer Signature  &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#160; &nbsp; &nbsp; &nbsp; &nbsp; Shreerang Jewellers</strong></p>
       
         
             
                <hr>
    </div>
    <div class="footer">
    <p>Note: This software is developed by Soft2Technologies, Amravati</p>
</div>

    


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> -->
    </script>
</body>

</html>