<?php
require_once __DIR__ . '/vendor/autoload.php'; // Include the mPDF library

$mpdf = new \Mpdf\Mpdf();

// Define the file path where you want to save the PDF
$filePath = __DIR__ . '/blank.pdf';

// Save the blank PDF to the specified path
$mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

echo "Blank PDF has been saved to $filePath";
?>