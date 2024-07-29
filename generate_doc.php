<?php
// Manually include PHPWord files
require 'PHPWord/src/PhpWord/PhpWord.php';
require 'PHPWord/src/PhpWord/IOFactory.php';
// require 'PHPWord/src/PhpWord/SimpleType/Jc.php';

// Use the PHPWord namespace
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
// use PhpOffice\PhpWord\SimpleType\Jc;

// Create a new PHPWord Object
$phpWord = new PhpWord();

// Define styles
$titleStyle = [
    'name' => 'Georgia',
    'size' => 15,
    'bold' => true,
    // 'alignment' => Jc::CENTER
];
$subtitleStyle = [
    'name' => 'Georgia',
    'size' => 12,
    'bold' => true,
    // 'alignment' => Jc::CENTER
];
$highlightStyle = [
    'name' => 'Calibri',
    'size' => 12,
    'bold' => true,
    'color' => 'FF0000'
];

// Add a section
$section = $phpWord->addSection();

// Add title
$section->addText('(REVISED FORMAT)', $titleStyle);

// Add empty line
$section->addText('', $titleStyle);

// Add subtitle
$section->addText('On Promoter\'s Letterhead DISCLOSURE OF SOLD/BOOKED INVENTORY', $titleStyle);

// Add subtitle
$section->addText('(BUILDING / Wing Wise)', $subtitleStyle);

// Add Project Name
$section->addText('Name of the Project:', $subtitleStyle);
$section->addText('Chetan Heights', $highlightStyle);

// Add Registration No
$section->addText('MahaRERA Registration No:', $subtitleStyle);
$section->addText('P000000000000000000', $highlightStyle);

// Save the document
$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save('document.docx');

echo 'Document created successfully!';
?>
