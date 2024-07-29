<?php 
require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed
\PhpOffice\PhpWord\Autoloader::register();

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Output success message
echo "Document created successfully: $filename";
?>