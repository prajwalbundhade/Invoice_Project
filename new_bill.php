<?php
@include 'dbconn.php';
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
        <div class="row">
            <div class="col-sm">

                <table>
                    <form action="" method='POST'>

                        <!-- Uder detail -->
                        <h3>Customer Details</h3>
                        <tr>
                            <td>
                                <label for="">Shop Address
                                    <input type="text" class="" name="shop_address" value="Gadge Nagar, Amravati"
                                        readonly>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">GSTIN/UIN
                                    <input type="text" class="" name="gstin" placeholder="GSTIN/UIN">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Date
                                    <input type="date" class="" name="date" placeholder="Date">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Name of Customer
                                    <input type="text" class="" name="name" placeholder="Ex. John cena">
                                </label>
                            </td>
                        </tr>



                        <tr>
                            <td>
                                <label for="">Customer Address
                                    <input type="text" class="" name="address" placeholder="Enter Addres">
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="">State
                                    <input type="text" class="" name="state" placeholder="State">
                                </label>
                            </td>
                        </tr>
                        <tr>


                </table>





            </div>

            <!-- Product detail -->
            <div class="col-sm">



                <tr>
                    <h3>Product Details</h3>

                </tr>
                <tr>
                    <td>
                        <label for="">Description of goods
                            <input type="text" class="" name="description" placeholder="Description">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""> Karet
                            <input type="text" class="" name="karet" placeholder="Enter Karet">
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for=""> HSN Code
                            <input type="text" class="" name="hsncode" placeholder="Enter HSN code">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""> Gross Weight
                            <input type="number" class="" name="gross_weight1" step="0.00000001"
                                placeholder="Enter Gross Weight in gram">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""> Net Weight
                            <input type="number" class="" name="net_weight" step="0.000001"
                                placeholder="Enter net weight in gram">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""> Rate
                            <input type="number" class="" name="rate" step="0.000001" placeholder="Enter Rate in Rs.">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for=""> Labour Charge
                            <input type="number" class="" name="labour_charge" step="0.0000001"
                                placeholder="Enter labour charge">
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">
                            <input type="submit" class="" name="submit-1" placeholder="Submit">
                        </label>
                    </td>
                </tr>
                <!-- Product detail end-->
                </form>

                </table>


                <?php

    $total_amount = 0.0;
    $sgst_amount = 0.0;
    $cgst_amount = 0.0;
    $gst_total = 0.0;
    $total_amount_after_taxes = 0;

//    for customer details

if (isset($_POST['submit-1'])) {
    // Retrieve values from the form
    $number = $_POST['number'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $gstin = $_POST['gstin'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $shop_address = $_POST['shop_address'];

    $description = $_POST['description'];
    $karet = $_POST['karet'];
    $hsncode = $_POST['hsncode'];
    $gross_weight = $_POST['gross_weight1'];
    $net_weight = (float)$_POST['net_weight'];
    $rate = (float)$_POST['rate'];
    $labour_charge = (float)$_POST['labour_charge'];

    // Calculate total amount and GST
    $total_amount = ($net_weight * $rate) + $labour_charge;
    $sgst_percentage = 1.5;
    $cgst_percentage = 1.5;
    $sgst_amount = ($total_amount * $sgst_percentage) / 100;
    $cgst_amount = ($total_amount * $cgst_percentage) / 100;
    $gst_total = $sgst_amount + $cgst_amount;
    $total_amount_after_taxes = $total_amount + $gst_total;

    // Create the INSERT INTO query
    $insert_query = "INSERT INTO `customer_details`(
        `number`,
        `name`,
        `date`,
        `gstin`,
        `address`,
        `state`,
        `shop_address`,
        `description`,
        `karet`,
        `hsncode`,
        `gross_weight1`,
        `net_weight`,
        `rate`,
        `labour_charge`,
        `total_amount`,
        `sgst_amount`,
        `cgst_amount`,
        `gst_total`,
        `total_amount_after_taxes`)
    VALUES (
        '$number',
        '$name',
        '$date',
        '$gstin',
        '$address',
        '$state',
        '$shop_address',
        '$description',
        '$karet',
        '$hsncode',
        '$gross_weight',
        '$net_weight',
        '$rate',
        '$labour_charge',
        '$total_amount',
        '$sgst_amount',
        '$cgst_amount',
        '$gst_total',
        '$total_amount_after_taxes')";

    // Execute the query
    $query = mysqli_query($conn, $insert_query);

    if ($query) {
        echo "Customer data saved";
    } else {
        echo "Something went wrong";
    }
}
?>
            </div>
            <div class="col-sm">
                <?php
// Calculate total amount before taxes

// Initialize variables

?>
                <!-- total amount and GST  -->
                <h3>Final Bill</h3>



                <div class="bill-container">

                    <p>Total Amount before Taxes: <?php echo $total_amount; ?></p>
                    <b>
                        <p>Tax Amount GST 3%</p>
                    </b>
                    <p>SGST: <?php echo $sgst_amount; ?></p>
                    <p>CGST: <?php echo $cgst_amount; ?></p>
                    <p>Total GST (SGST + CGST): <?php echo $gst_total; ?></p>

                    <p>Total Amount after Taxes: <?php echo $total_amount_after_taxes; ?></p>


                    <p><a href="dashboard.php" class="btn btn-danger"><i class="fa-solid fa-house"></i> Go To Home</a></p>



                </div>
            </div>
        </div>
    </div>

    <!--code for pdf  -->




</body>


</html>