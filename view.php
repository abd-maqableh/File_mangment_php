<?php
if (isset($_GET['show_file']))
{
    $file =  $_GET['show_file'];

    if (is_file($file)) {

        $type = pathinfo($file,PATHINFO_EXTENSION );
        if ($type  === 'txt' ||$type  === 'html' ) {
            readfile($file);
        }
        if (exif_imagetype($file) ) {
            echo ' <img src="data:image/png;base64,'.base64_encode(file_get_contents($file)).'" />';
        }

        if ($type === "pdf") {
            $filename = $file;
            header("Content-type: application/pdf");
            header("Content-Length: " . filesize($filename));
            readfile($filename);
        }
        if ($type === "docx" || $type === "doc")
        {

            header('Content-disposition: inline');
            header('Content-type: application/msword'); // not sure if this is the correct MIME type
            readfile($file);
        }
    }
}