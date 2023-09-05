<!DOCTYPE html>
<html>

<head>
    <title>Tax Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
    }

    .invoice {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .shop-name {
        font-size: 28px;
        font-weight: bold;
        color: #555;
    }

    .address {
        margin-top: 10px;
        color: #555;
    }

    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .table th {
        background-color: #f5f5f5;
    }

    .total-table {

        margin-top: 20px;
        width: 100%;
        text-align: right;
    }

    .tax-details {
        width: 50%;

        margin-top: 20px;
    }

    .signature-container {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .signature1 {
        /* margin-top: 30px; */
        text-align: left;
    }

    .signature2 {
        /* margin-top: 30px; */
        text-align: right;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice">
            <div class="invoice-header">
                <h1>Tax Invoice</h1>
                <h2 class="shop-name">Shreerang Jwellers</h2>
                <div class="address">Address: Sarafa Line, Main Road, Yawatmal- 445001</div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div>
                        Mob No.: 8482855422
                    </div>
                    <div>GST No.: 27EYUPS6827P1ZY</div>
                </div>
                <hr>
            </div>
            <div class="customer-details">
                <div><strong>Date:</strong> <?php echo $purchaseDetails['date']; ?></div>
                <div><strong>Bill No.:</strong> <?php echo $purchaseDetails['customer_id']; ?></div>
                <div><strong>Customer Name:</strong> <?php echo $purchaseDetails['name']; ?></div>
                <div><strong>State:</strong> <?php echo $purchaseDetails['state']; ?></div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Description</th>
                        <th>Net Weight</th>
                        <th>Gross Weight</th>
                        <th>HSN Code</th>
                        <th>Rate</th>
                        <th>Labour Charge</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?php echo $purchaseDetails['description']; ?></td>
                        <td><?php echo $purchaseDetails['net_weight']; ?></td>
                        <td><?php echo $purchaseDetails['gross_weight1']; ?></td>
                        <td><?php echo $purchaseDetails['hsncode']; ?></td>
                        <td><?php echo $purchaseDetails['rate']; ?></td>
                        <td><?php echo $purchaseDetails['labour_charge']; ?></td>
                        <td><?php echo $purchaseDetails['total_amount']; ?></td>
                    </tr>
                    <!-- Add more product rows as needed -->
                </tbody>
            </table><br>
            <div class="tax-details">
                <table class="table total-table">
                    <tr>
                        <td colspan="7"><strong>Total Before Tax</strong></td>
                        <td><?php echo $purchaseDetails['total_amount']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>SGST</strong></td>
                        <td><?php echo $purchaseDetails['sgst_amount']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>CGST</strong></td>
                        <td><?php echo $purchaseDetails['cgst_amount']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>GST</strong></td>
                        <td><?php echo $purchaseDetails['gst_total']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>Grand Total</strong></td>
                        <td><?php echo $purchaseDetails['total_amount_after_taxes']; ?></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div class="signature-container">
                <div class="signature1">
                    Customer Signature:</div>
                <div class="signature2">
                    Shop Owner Signature:
                </div>
            </div>
        </div>
    </div>
</body>

</html>