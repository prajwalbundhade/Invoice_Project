<?php
@include 'dbconn.php'; // Include your database connection file

$total_amount = 0.0;
$sgst_amount = 0.0;
$cgst_amount = 0.0;
$gst_total = 0.0;
$total_amount_after_taxes = 0.0;

if (isset($_POST['submit-1'])) {
    // Retrieve customer details from the form
    $shop_address = $_POST['shop_address'];
    $gstin = $_POST['gstin'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $state = $_POST['state'];

    // Insert customer details into the database
    $customer_insert_query = "INSERT INTO new_customer_details (shop_address, gstin, date, name, address, state) 
                              VALUES ('$shop_address', '$gstin', '$date', '$name', '$address', '$state')";

    if (mysqli_query($conn, $customer_insert_query)) {
        $customer_id = mysqli_insert_id($conn); // Get the ID of the inserted customer record

        // Initialize total amount for products
        $total_amount = 0.0;

        // Loop through each product
        foreach ($_POST['description'] as $key => $description) {
            $karet = $_POST['karet'][$key];
            $hsncode = $_POST['hsncode'][$key];
            $gross_weight = $_POST['gross_weight'][$key];
            $net_weight = (float)$_POST['net_weight'][$key];
            $rate = (float)$_POST['rate'][$key];
            $labour_charge = (float)$_POST['labour_charge'][$key];

            // Calculate total amount for the product
            $product_total_amount = ($net_weight * $rate) + $labour_charge;
            
            // Add product total to the overall total
            $total_amount += $product_total_amount;

            // Insert product details into the database
            $product_insert_query = "INSERT INTO product_details (customer_id, description, karet, hsncode, gross_weight, net_weight, rate, labour_charge, total_amount) 
                                     VALUES ('$customer_id', '$description', '$karet', '$hsncode', '$gross_weight', '$net_weight', '$rate', '$labour_charge', '$product_total_amount')";

            mysqli_query($conn, $product_insert_query);
        }

        // Calculate GST amounts
        $sgst_percentage = 1.5;
        $cgst_percentage = 1.5;
        $sgst_amount = ($total_amount * $sgst_percentage) / 100;
        $cgst_amount = ($total_amount * $cgst_percentage) / 100;
        $gst_total = $sgst_amount + $cgst_amount;
        $total_amount_after_taxes = $total_amount + $gst_total;

        // Insert final bill data into the database
        $final_bill_insert_query = "INSERT INTO final_bill (customer_id, total_amount, sgst_amount, cgst_amount, gst_total, total_amount_after_taxes) 
                                    VALUES ('$customer_id', '$total_amount', '$sgst_amount', '$cgst_amount', '$gst_total', '$total_amount_after_taxes')";

        if (mysqli_query($conn, $final_bill_insert_query)) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Bill form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>

    <div class="container">
        <h1>Tax Invoice</h1>
        <form action="" method="POST">
            <!-- Customer Details Section -->
            <!-- Customer Details -->
            <h3>Customer Details</h3>
            <div class="row">
                <div class="col-md-3">

                    <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input type="text" class="form-control" id="shop_address" name="shop_address"
                            value="Gadge Nagar, Amravati" readonly>
                    </div>
                    <div class="form-group">
                        <label for="gstin">GSTIN/UIN</label>
                        <input type="text" class="form-control" id="gstin" name="gstin" placeholder="GSTIN/UIN">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <label for="name">Name of Customer</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ex. John cena">
                    </div>
                    <div class="form-group">
                        <label for="address">Customer Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="State">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bill-container">
                        <h3>Final Bill</h3>
                        <p>Total Amount before Taxes: <span id="total_amount"><?php echo $total_amount; ?></span></p>
                        <b>
                            <p>Tax Amount GST 3%</p>
                        </b>
                        <p>SGST: <span id="sgst_amount"><?php echo $sgst_amount; ?></span></p>
                        <p>CGST: <span id="cgst_amount"><?php echo $cgst_amount; ?></span></p>
                        <p>Total GST (SGST + CGST): <span id="gst_total"><?php echo $gst_total; ?></span></p>
                        <p>Total Amount after Taxes: <span
                                id="total_amount_after_taxes"><?php echo $total_amount_after_taxes; ?></span></p>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->

            <h3>Product Details</h3>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Description of Goods</th>
                                <th>Karet</th>
                                <th>HSN Code</th>
                                <th>Gross Weight</th>
                                <th>Net Weight</th>
                                <th>Rate (Rs.)</th>
                                <th>Labour Charge</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="description[]"
                                        placeholder="Description"></td>
                                <td><input type="text" class="form-control" name="karet[]" placeholder="Enter Karet">
                                </td>
                                <td><input type="text" class="form-control" name="hsncode[]"
                                        placeholder="Enter HSN code"></td>
                                <td><input type="number" class="form-control" step="0.00000001" name="gross_weight[]"
                                        placeholder="Enter Gross Weight in gram"></td>
                                <td><input type="number" class="form-control" step="0.000001" name="net_weight[]"
                                        placeholder="Enter net weight in gram"></td>
                                <td><input type="number" class="form-control" step="0.000001" name="rate[]"
                                        placeholder="Enter Rate in Rs."></td>
                                <td><input type="number" class="form-control" step="0.0000001" name="labour_charge[]"
                                        placeholder="Enter labour charge"></td>
                                <td><button type="button" class="btn btn-danger delete-product">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="button" class="btn btn-success" id="addProduct">Add Another Product</button>
            <button type="submit" class="btn btn-success" name="submit-1">Submit</button>
           
    </div>
    </div>
    <!-- Final Bill Section -->
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>

    </form>
    </div>

    <script>
    // JavaScript code for adding new product rows and deleting them
    document.addEventListener('DOMContentLoaded', function() {
        const addProductButton = document.getElementById('addProduct');
        const productTableBody = document.querySelector('table tbody');

        addProductButton.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                    <td><input type="text" class="form-control" name="description[]" placeholder="Description"></td>
                    <td><input type="text" class="form-control" name="karet[]" placeholder="Enter Karet"></td>
                    <td><input type="text" class="form-control" name="hsncode[]" placeholder="Enter HSN code"></td>
                    <td><input type="number" class="form-control" step="0.00000001" name="gross_weight[]" placeholder="Enter Gross Weight in gram"></td>
                    <td><input type="number" class="form-control" step="0.000001" name="net_weight[]" placeholder="Enter net weight in gram"></td>
                    <td><input type="number" class="form-control" step="0.000001" name="rate[]" placeholder="Enter Rate in Rs."></td>
                    <td><input type="number" class="form-control" step="0.0000001" name="labour_charge[]" placeholder="Enter labour charge"></td>
                    <td><button type="button" class="btn btn-danger delete-product">Delete</button></td>
                `;

            productTableBody.appendChild(newRow);
        });

        // Delete product row
        productTableBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-product')) {
                event.preventDefault();
                event.target.closest('tr').remove();
            }
        });
    });
    </script>
</body>

</html>