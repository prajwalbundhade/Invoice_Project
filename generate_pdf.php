<?php
include 'dbconn.php';
require_once('TCPDF-main/tcpdf.php'); // Path to TCPDF library

if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer details, product details, and final bill details based on the bill number
    $sql = "SELECT
                ncd.`customer_id`,
                ncd.`name`,
                ncd.`state`,
                ncd.`address`,
                ncd.`date`,
                pd.`description`,
                pd.`net_weight`,
                pd.`gross_weight`,
                pd.`hsncode`,
                pd.`rate`,
                pd.`labour_charge`,
                pd.`total_amount`,
                fb.`total_amount`,
                fb.`sgst_amount`,
                fb.`cgst_amount`,
                fb.`gst_total`,
                fb.`total_amount_after_taxes`
            FROM `new_customer_details` ncd
            INNER JOIN `product_details` pd ON ncd.`customer_id` = pd.`customer_id`
            INNER JOIN `final_bill` fb ON ncd.`customer_id` = fb.`customer_id`
            WHERE ncd.`customer_id` = '$billNumber'";

    $result = mysqli_query($conn, $sql);
    $purchaseDetails = mysqli_fetch_assoc($result);

    if ($purchaseDetails) {
        // Generate PDF using TCPDF
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Customer Purchase Details');
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $pdf->AddPage();

        ob_start();
        include('pdf_template1.php');
        $content = ob_get_clean();

        $pdf->writeHTML($content, true, false, true, false, '');

        // Output the PDF for download
        $pdf->Output('customer_purchase_details.pdf', 'D');
    } else {
        echo "No purchase details found for the provided bill number.";
    }
}
?>
