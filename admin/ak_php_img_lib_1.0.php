<?php
// ----------------------- RESIZE FUNCTION -----------------------
// Function for resizing any jpg, gif, or png image files
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 65);
    }
}
// -------------- THUMBNAIL (CROP) FUNCTION ---------------
// Function for creating a true thumbnail cropping from any jpg, gif, or png image files
function ak_img_thumb($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $src_x = ($w_orig / 2) - ($w / 2);
    $src_y = ($h_orig / 2) - ($h / 2);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
    $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
    $img = imagecreatefrompng($target);
    } else { 
    $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
    if ($ext == "gif"){ 
        imagegif($tci, $newcopy);
    } else if($ext =="png"){ 
        imagepng($tci, $newcopy);
    } else { 
        imagejpeg($tci, $newcopy, 84);
    }
}
// ----------------------- IMAGE CONVERT FUNCTION -----------------------
// Function for converting GIFs and PNGs to JPG upon upload
function ak_img_convert_to_jpg($target, $newcopy, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);
    $ext = strtolower($ext);
    $img = "";
    if ($ext == "gif"){ 
        $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
        $img = imagecreatefrompng($target);
    }
    $tci = imagecreatetruecolor($w_orig, $h_orig);
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 84);
}
// ----------------------- IMAGE WATERMARK FUNCTION -----------------------
// Function for applying a PNG watermark file to a file after you convert the upload to JPG
function ak_img_watermark($target, $wtrmrk_file, $newcopy, $mode) { 
    $watermark = imagecreatefrompng($wtrmrk_file); 
    imagealphablending($watermark, false); 
    imagesavealpha($watermark, true); 
    $img = imagecreatefromjpeg($target);
    $img_w = imagesx($img); 
    $img_h = imagesy($img); 
    $wtrmrk_w = imagesx($watermark); 
    $wtrmrk_h = imagesy($watermark); 
    /*$dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
    $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image*/
	
	if ($mode == 1)
	{
		$dst_x =  $img_w  -  $wtrmrk_w - 5;
		$dst_y =  $img_h  -  $wtrmrk_h - 5;
	}
	elseif ($mode == 2)
	{
		$dst_x =  5;
		$dst_y =  $img_h  -  $wtrmrk_h - 5;	
	}
	elseif ($mode == 3)
	{
		$dst_x =  $img_w  -  $wtrmrk_w - 5;
		$dst_y =  5;	
	}
	else
	{
		$dst_x =  5;
		$dst_y =  5;	
	}	
	
    imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h); 
    imagejpeg($img, $newcopy, 100); 
    imagedestroy($img); 
    imagedestroy($watermark); 
} 

function scale_image_plus($src_image_url, $dst_image_url, $w, $h, $ext)
{
    $src = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
    $src = imagecreatefromgif($src_image_url);
    } elseif ($ext =="png"){ 
    $src = imagecreatefrompng($src_image_url);
    } else { 
    $src = imagecreatefromjpeg($src_image_url);
    }

	$dst = imagecreatetruecolor($w, $h);
	imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));	
	
    $src_width = imagesx($src);
    $src_height = imagesy($src);
 
    $dst_width = imagesx($dst);
    $dst_height = imagesy($dst);	
	
	$new_width = $dst_width;
    $new_height = round($new_width*($src_height/$src_width));
    $new_x = 0;
    $new_y = round(($dst_height-$new_height)/2);	
	
	$next = $new_height < $dst_height;
	
	if ($next) 
	{
			$new_height = $dst_height;
			$new_width = round($new_height*($src_width/$src_height));
			$new_x = round(($dst_width - $new_width)/2);
			$new_y = 0;
	}
		
	imagecopyresampled($dst, $src , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
	
    if ($ext == "gif"){ 
        imagegif($dst, $dst_image_url);
    } else if($ext =="png"){ 
        imagepng($dst, $dst_image_url);
    } else { 
        imagejpeg($dst, $dst_image_url, 85);
    }	
}

?>