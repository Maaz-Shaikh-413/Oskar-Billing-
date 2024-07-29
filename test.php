<?php 
require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// Create a new PHPWord object
$phpWord = new PhpWord();



// Output success message
echo "Document created successfully: $filename";
?>