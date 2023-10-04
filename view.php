<?php
include 'dbconn.php';


// Retrieve the bill number
if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer details
    $sql = "SELECT * FROM `new_customer_details` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $customerDetails = mysqli_fetch_assoc($result);

    // Fetch product details
    $sql = "SELECT * FROM `product_details` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $productDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Fetch final bill details
    $sql = "SELECT * FROM `final_bill` WHERE `customer_id` = '$billNumber'";
    $result = mysqli_query($conn, $sql);
    $finalBillDetails = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Purchase Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dash_style.css">
    <style>
    .product-list {
        list-style-type: none;
        padding: 0;
    }

    .product-list-item {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .product-list-item h4 {
        margin-bottom: 10px;
    }
    </style>
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

        <main class="container mt-4">
            <?php if (isset($customerDetails)) { ?>
            <section>
                <h2>Customer Purchase Details for: <?php echo $customerDetails['name']; ?></h2>
                <!-- Customer details -->
                <p><strong>Bill Number:</strong> <?php echo $customerDetails['customer_id']; ?></p>
                <p><strong>Customer Name:</strong> <?php echo $customerDetails['name']; ?></p>
                <p><strong>Date of Purchase:</strong> <?php echo $customerDetails['date']; ?></p>
                <p><strong>Address:</strong> <?php echo $customerDetails['address']; ?></p>
                <p><strong>State:</strong> <?php echo $customerDetails['state']; ?></p>
                <p><strong>Shop Address:</strong> <?php echo $customerDetails['shop_address']; ?></p>

                <!-- Product details -->
                <h3>Products Purchased:</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Product Name</th>
                            <th>Net Weight</th>
                            <th>Gross Weight</th>
                            <th>HSN Code</th>
                            <th>Rate</th>
                            <th>Labour Charge</th>
                            <th>Total Amount (in Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            foreach ($productDetails as $product) { ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo number_format($product['net_weight'], 3); ?></td>
                            <td><?php echo $product['gross_weight']; ?></td>
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

                <!-- Final bill details -->
                <h3>Final Bill Details:</h3>
                <p><strong>Total Amount:</strong> <?php echo $finalBillDetails['total_amount']; ?></p>
                <p><strong>SGST Amount (1.5%):</strong> <?php echo $finalBillDetails['sgst_amount']; ?></p>
                <p><strong>CGST Amount (1.5%):</strong> <?php echo $finalBillDetails['cgst_amount']; ?></p>
                <p><strong>GST Amount (3%):</strong> <?php echo $finalBillDetails['gst_total']; ?></p>
                <p><strong>Total Amount after Taxes:</strong>
                    <?php echo $finalBillDetails['total_amount_after_taxes']; ?></p>

                <!-- Download PDF button -->
                <a href="generate_pdf.php?customer_id=<?php echo $customerDetails['customer_id']; ?>"
                    class="btn btn-danger" target="_blank"><i class="fa fa-download"></i> Download PDF</a>
            </section>
            <?php } else { ?>
            <section>
                <p>No purchase details found for the provided bill number.</p>
            </section>
            <?php } ?>
        </main>

        <!-- JavaScript and Bootstrap JS -->
        <script src="script.js"></script>
        <script src="https://kit.fontawesome.com/f2786c0b81.js" crossorigin="anonymous"></script>
</body>

</html>