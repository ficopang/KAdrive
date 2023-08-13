<?php

/**
 * ///////////////////////////////////////
 * 
 * Upload File:
 * -> Validate file type
 * -> Validate file size
 * -> Generate unique name
 * -> Move uploaded file to desired folder
 * -> Can handle multiple file upload
 * -> Use *echo* to return something (whether it's error or success message)
 * 
 * ///////////////////////////////////////
 */

//  !!CODE START HERE
if (isset($_FILES['file']) && isset($_GET['id']) && isset($_GET['dir'])) {
    $errorMsg = array();

    $file = $_FILES['file'];
    // print_r($file);
    if (
        $file["size"] == 0 && !is_uploaded_file($file['tmp_name'][0])
    ) {
        array_push($errorMsg, "File must be chosen");
    } else {
        $target_directory = '../all-drives/' . $_GET['dir'];
        $file_name = $target_directory . basename($file["name"][0]);
        $mime_type = mime_content_type($file["tmp_name"][0]);

        if (!in_array(
            $mime_type,
            array('text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'image/jpeg', 'image/png', 'image/gif', '	video/mp4')
        )) {
            array_push(
                $errorMsg,
                "File type uploaded can only txt, xlsx, image (jpg, jpeg, png, gif), and video (mp4)"
            );
        } else {
            if (file_exists($file_name))
                array_push($errorMsg, "File already exist!");
            if ($file["size"][0] > 5000000)
                array_push($errorMsg, "File size uploaded must be less than 5 MB");
            if (count($errorMsg) == 0) {
                move_uploaded_file($file['tmp_name'][0], $file_name);
            }
        }
    }

    if (count($errorMsg) > 0) {
        echo $errorMsg[0];
    } else {
        echo "Upload sucess!";
    }
}
// END HERE