<?php
// json_encode test

$_SESSION['bonus_coupon'] = array();				


$_SESSION['bonus_coupon'][0]= array('bonus_name' => $row['name'], 
									'bonus_type' => $row['type'], 
									'bonus_par1' => $row['par1'],
									'bonus_par2' => $row['par2'],
									'bonus_display_name' => $row['display_name']);

echo json_encode($_SESSION['bonus_coupon']);

?>