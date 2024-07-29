<?php 
require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// // Creating the new document...
// $phpWord = new \PhpOffice\PhpWord\PhpWord();


$phpWord = IOFactory::load('your_existing_document.docx'); // Path to your existing document


// Output success message
echo "Document created successfully: $filename";
?>