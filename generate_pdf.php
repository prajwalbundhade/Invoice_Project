<?php
require 'vendor/autoload.php';
include 'dbconn.php';
use Dompdf\Dompdf;

// Retrieve the bill number
if (isset($_GET['customer_id'])) {
    $billNumber = $_GET['customer_id'];

    // Fetch customer details, product details, and final bill details as before

    // Create a new Dompdf instance
    $pdf = new Dompdf();

    // Load HTML content
    ob_start();
    include 'pdf_template.php'; // Create a separate HTML template file
    $html = ob_get_clean();

    $pdf->loadHtml($html);

    // Set paper size and orientation (e.g., 'A4' or 'letter')
    $pdf->setPaper('A4');

    // Render PDF (optional: you can save the PDF instead of outputting it)
    $pdf->render();

    // Output the PDF as a download
    $pdf->stream('Customer_Purchase_Details.pdf', ['Attachment' => 0]);

    // JavaScript to open the PDF in a new window/tab
    echo '<script>window.open("data:application/pdf;base64,' . base64_encode($pdf->output()) . '","_blank");</script>';
}
?>
