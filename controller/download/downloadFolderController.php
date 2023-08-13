<?php

/**
 * ///////////////////////////////////////
 * 
 * Download Folder Controller:
 * -> Download the choosed folder and its whole content
 * -> Zip it all
 * -> If success, redirect to the previous page
 * -> If not, redirect to the previous page and show error message
 * 
 * ///////////////////////////////////////
 */

//  !!CODE START HERE

if (isset($_GET['source']) && isset($_GET['folder'])) {
    $dir = "../../all-drives" . $_GET['source'];
    $zip_file = $_GET['folder'] . '.zip';

    // Get real path for our folder
    $rootPath = realpath($dir);

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Skip directories (they would be added automatically)
        if (!$file->isDir()) {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();


    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($zip_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// END HERE