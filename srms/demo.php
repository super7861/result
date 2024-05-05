<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Get the active sheet
$sheet = $spreadsheet->getActiveSheet();

// Add header row
$sheet->fromArray([
    'Student Name', 'Roll Id', 'Class Numeric', 'Class Name', 'Subject 1', 'Marks 1',
    'Subject 2', 'Marks 2', 'Subject 3', 'Marks 3', 'Subject 4', 'Marks 4'
], NULL, 'A1');

// Add sample data
$sheet->fromArray([
    'John Doe', '001', '10', 'Science', 'Math', '90', 'Physics', '85', 'Chemistry', '88', 'Biology', '92'
], NULL, 'A2');

// Set column auto size
foreach (range('A', 'L') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Save the Excel file
$writer = new Xlsx($spreadsheet);
$writer->save('demo_excel_file.xlsx');

echo 'Excel file created successfully.';
