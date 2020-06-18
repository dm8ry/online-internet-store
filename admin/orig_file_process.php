<?php
include_once("ak_php_img_lib_1.0.php");

$watermark_position = $_POST["watermark_position"];
$size_position = $_POST["size_position"];
$the_file_name = $_POST["the_file_name"];

$target_file = $the_file_name; // Initial File To Process
$target_file_info = pathinfo($target_file);
$target_file_ext = $target_file_info['extension'];

$target_file_2 = $target_file_info['dirname']."/".$target_file_info['filename']."_scale.".$target_file_info['extension']; // Scale

$target_file_3 = $target_file_info['dirname']."/".$target_file_info['filename']."_jpeg.".$target_file_info['extension']; // Jpeg

$target_file_4 = $target_file_info['dirname']."/".$target_file_info['filename']."_watermark.".$target_file_info['extension']; // Watermark

$target_file_5 = $target_file_info['dirname']."/".$target_file_info['filename']."_processed.".$target_file_info['extension']; // Processed

if ($size_position == 1)
{
	scale_image_plus($the_file_name, $target_file_2, 300, 300, $target_file_ext);
}
elseif($size_position == 2)
{
	scale_image_plus($the_file_name, $target_file_2, 350, 350, $target_file_ext);
}
elseif($size_position == 3)
{
	scale_image_plus($the_file_name, $target_file_2, 400, 400, $target_file_ext);
}
elseif($size_position == 4)
{
	scale_image_plus($the_file_name, $target_file_2, 450, 450, $target_file_ext);
}
else
	copy($the_file_name, $target_file_2);


if ($target_file_ext != 'jpg')
{
	ak_img_convert_to_jpg($target_file_2, $target_file_3, $target_file_ext);	
}
else
{
	copy($target_file_2, $target_file_3);
}
	
	
$wtrmrk_file = "assets/img/watermark_2.png";

if ($watermark_position >= 1 && $watermark_position <= 4)
{
	ak_img_watermark($target_file_3, $wtrmrk_file, $target_file_4, $watermark_position);	
}
else
{
	copy($target_file_3, $target_file_4);
}
 
copy($target_file_4, $target_file_5); 

echo $target_file_5;

?>