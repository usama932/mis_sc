<?php
$zip = new ZipArchive;
$fileName = 'D:/test_backup.zip';

echo "Trying to create zip file at: $fileName\n";

if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
    $zip->addFromString('testfile.txt', 'This is a test file.');
    $zip->close();
    echo "Zip file created successfully!\n";
} else {
    echo "Failed to create zip file\n";
}