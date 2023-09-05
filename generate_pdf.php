<?php
include 'dbconn.php';
require_once('TCPDF-main/tcpdf.php'); // Path to TCPDF library

if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer purchase details based on the bill number
    $sql = "SELECT * FROM `customer_details` WHERE `customer_id` = '$billNumber'";
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
