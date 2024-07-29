<?php 
require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// // Creating the new document...
// $phpWord = new \PhpOffice\PhpWord\PhpWord();


$phpWord = IOFactory::load('assets/original-docs/new-inventory-doc.docx'); // Path to your existing document

// Find the token and replace it with a table
$token = '$TABLE_ALL_UNITS';
$sections = $phpWord->getSections();

foreach ($sections as $section) {
    foreach ($section->getElements() as $element) {
        if (method_exists($element, 'getText') && $element->getText() === $token) {
            // Remove the token
            $section->removeElement($element);

            // Create a new table
            $table = $section->addTable();

            // Example: Adding rows and cells dynamically
            $data = [
                ['Header 1', 'Header 2', 'Header 3'],
                ['Row 1, Cell 1', 'Row 1, Cell 2', 'Row 1, Cell 3'],
                ['Row 2, Cell 1', 'Row 2, Cell 2', 'Row 2, Cell 3'],
            ];

            // Add the rows and cells to the table
            foreach ($data as $row) {
                $table->addRow();
                foreach ($row as $cell) {
                    $table->addCell(2000)->addText($cell);
                }
            }
        }
    }
}

// Save the modified document
$phpWord->save('modified_document.docx', 'Word2007', true);

// Output success message
echo "Document created successfully: ";
?>