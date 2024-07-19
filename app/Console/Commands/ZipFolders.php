<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ZipArchive;
use File;

class ZipFolders extends Command
{
    protected $signature = 'folders:zip';
    protected $description = 'Zip the storage and public folders and store in drive D';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $baseFileName = "D:/auto_backup/mis_attachments_".date('d-M-Y H-i-s').".zip";
        $fileName = $this->makeUniqueFileName($baseFileName);

        if (!File::isWritable(dirname($fileName))) {
            $this->error('Destination path is not writable.');
            return;
        }

        $zip = new ZipArchive;

        if ($zip->open($fileName, ZipArchive::CREATE) === true) {
            try {
                // Add storage folder contents to zip
                $this->addFolderToZip(storage_path(), $zip);

                // Close zip archive
                $zip->close();

                // Check if zip file was created successfully
                if (file_exists($fileName)) {
                    $this->info('Folders zipped successfully! File saved to ' . $fileName);
                } else {
                    $this->error('Failed to create zip file.');
                }
            } catch (\Exception $e) {
                $this->error('Failed to add files to zip: ' . $e->getMessage());
            }
        } else {
            $this->error('Failed to open zip file for writing.');
        }
    }

    private function makeUniqueFileName($baseFileName)
    {
        $fileName = $baseFileName;
        $counter = 1;

        // Check if the file already exists
        while (file_exists($fileName)) {
            // Append a counter to the base file name to make it unique
            $fileName = $baseFileName . '_' . $counter;
            $counter++;
        }

        return $fileName;
    }

    private function addFolderToZip($folder, $zip)
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folder));

        foreach ($files as $name => $file) {
            // Skip directories
            if ($file->isDir()) {
                continue;
            }

            // Get real path and relative path within the zip
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folder) + 1);

            // Add file to zip with its relative path
            $zip->addFile($filePath, $relativePath);
        }
    }
}
