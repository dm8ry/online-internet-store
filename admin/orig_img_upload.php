<?php

$files = glob('uploads/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

$fileName = $_FILES["my-file-selector"]["name"]; // The file name
$fileTmpLoc = $_FILES["my-file-selector"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["my-file-selector"]["type"]; // The type of file it is
$fileSize = $_FILES["my-file-selector"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["my-file-selector"]["error"]; // 0 for false... and 1 for true
$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); // filter
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension

// START PHP Image Upload Error Handling -------------------------------
if (!$fileTmpLoc) { // if file not chosen
    echo "Ошибка! Файл не выбран!";
    exit();
} else if($fileSize > 307200) { // if file size is larger than 300KByte
    echo "Ошибка! Файл больше 300КБайт!";
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    exit();
} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     echo "Ошибка! Файл не .gif/.jpg/.png.";
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    echo "Ошибка!";
    exit();
} 

if (isset($fileTmpLoc)) {  
    list($width, $height) = getimagesize($fileTmpLoc);

	if ($width < 300 || $height < 300)
	{
		echo "Ошибка! Длина и ширина фото не менее 300!";
		exit();	
	}
	else
	{
		// everything is good!
	}
}
else
{
    echo "Ошибка!";
    exit();
}
 
// Place it into your "uploads" folder mow using the move_uploaded_file() function
$moveResult = move_uploaded_file($fileTmpLoc, "uploads/$fileName");
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    echo "Ошибка! Попробуйте еще!";
    exit();
}

echo "uploads/$fileName";

?>