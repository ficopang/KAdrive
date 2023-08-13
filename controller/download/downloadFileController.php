<?php

/**
 * ///////////////////////////////////////
 * 
 * Download File Controller:
 * -> Download the choosed file
 * -> If success, redirect to the previous page
 * -> If not, redirect to the previous page and show error message
 * 
 * ///////////////////////////////////////
 */

//  !!CODE START HERE
if (
    isset($_GET['source'])
) {
    $url = "../../a" . $_GET['source'];

    //Define header information
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($url) . '"');
    header('Content-Length: ' . filesize($url));
    header('Pragma: public');

    //Clear system output buffer
    flush();

    //Read the size of the file
    readfile($url, true);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


// END HERE