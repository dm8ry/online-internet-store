<?php session_start(); 

if (!$_SESSION['auth_login'])
{
	header("Location: index.php");
	exit;
}

require_once("./../db_connect.php");

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$conn->query("set names 'utf8'");

/*
$query1_0 = "truncate table admin_dashboard_query1";

$conn->query($query1_0);

$query1 = "insert into admin_dashboard_query1 
	       select date_format(bl.datex,'%d-%m') d_of_week, count(distinct(bl.ip_addr)) n_of_uniq_visitors
		   from businesslog_logins_rep bl
		   where bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 7 DAY)
		   group by date_format(bl.datex,'%d-%m')
		   order by bl.datex";

$conn->query($query1);	   

$query2_0 = "truncate table admin_dashboard_query2";

$conn->query($query2_0);

$query2 = "insert into admin_dashboard_query2 
		   select 
			case 
				when date_format(bl.datex,'%e') 
						in ('2', '4' , '6', '8', '10', '12', '14', '16', '18', '20', '22', '24', '26', '28', '30') 
					then '.' 
					else date_format(bl.datex,'%e') 
				end how_to_show, 
			count(distinct(bl.ip_addr)) n_of_uniq_visitors
		   from businesslog_logins_rep bl
		   where bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY)
		   group by date_format(bl.datex,'%e')
		   order by bl.datex";
	
$conn->query($query2);	
	
$query3_0 = "truncate table admin_dashboard_query3";	
	
$conn->query($query3_0);
	
$query3 = "insert into admin_dashboard_query3
			select M.day_week, M.dwname,  count(distinct(bl.ip_addr)) n_of_uniq_visitors
			from day_week M
			left outer join 
			businesslog_logins_rep bl on date_format(bl.datex, '%w') =M.day_week 									
							and bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY) 
			group by M.day_week, M.dwname
			order by M.day_week";

$conn->query($query3);			
			
$query4_0 = "truncate table admin_dashboard_query4";	
	
$conn->query($query4_0);
	
$query4 = "insert into admin_dashboard_query4
			select M.ord, M.hh24,  count(distinct(bl.ip_addr)) n_of_uniq_visitors
			from dim_hours M
			left outer join 
			businesslog_logins_rep bl on date_format(bl.datex, '%H') =M.hh24 									
							and bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY) 
			group by M.ord, M.hh24
			order by M.ord";

$conn->query($query4);	

$query10_0 = "truncate table admin_dashboard_query10";	
	
$conn->query($query10_0);
	
$query10 = "insert into admin_dashboard_query10
				select mc.name, count(1) n_of_products
				from products p, 
					sub_category sc, 
					main_category mc 
				where 
					p.status =1 
				and 
					sc.id = p.category 
				and 
					sc.main_category = mc.id
				group by mc.name
				order by 2 desc";

$conn->query($query10);	
 
$query400_0 = "truncate table admin_dashboard_query400";	
	
$conn->query($query400_0);
	
$query400 = "insert into admin_dashboard_query400
				SELECT date_format(bl.datex, '%H') hh24, count(distinct(bl.ip_addr)) n_of_uniq_visitors 
				FROM businesslog_logins_rep bl
				where bl.datex >= (now() + INTERVAL 10 HOUR - INTERVAL 23 HOUR) 
				group by date_format(bl.datex, '%H')
				order by bl.datex";

$conn->query($query400); 

*/

/*
$query_prepare_businesslog_logins_1 = "insert into businesslog_logins_rep select * from businesslog_logins";
$query_prepare_businesslog_logins_2 = "delete from businesslog_logins";
$conn->query($query_prepare_businesslog_logins_1);
$conn->query($query_prepare_businesslog_logins_2);
*/

$query1 = "select * from admin_dashboard_query1";
 		
$the_data1 = array();		

$results_the_data1 = mysqli_query($conn, $query1); 	

while($line = mysqli_fetch_assoc($results_the_data1)){
	$the_data1[] = $line;
}

$query2 = "select * from admin_dashboard_query2";
		
$the_data2 = array();		

$results_the_data2 = mysqli_query($conn, $query2); 	

while($line = mysqli_fetch_assoc($results_the_data2)){
	$the_data2[] = $line;
}		
	
$query3 = "select * from admin_dashboard_query3";
	
$the_data3 = array();
		
$results_the_data3 = mysqli_query($conn, $query3); 	

while($line = mysqli_fetch_assoc($results_the_data3)){
	$the_data3[] = $line;
}		
	
$query4 = "select * from admin_dashboard_query4";
			
$the_data4 = array();		

$results_the_data4 = mysqli_query($conn, $query4); 	

while($line = mysqli_fetch_assoc($results_the_data4)){
	$the_data4[] = $line;
}	

$query10 = "select * from admin_dashboard_query10";

$the_data10 = array();		
$results_the_data10 = mysqli_query($conn, $query10); 	

while($line = mysqli_fetch_assoc($results_the_data10)){
	$the_data10[] = $line;
}	

$query400 = "select * from admin_dashboard_query400";

$the_data400 = array();		
$results_the_data400 = mysqli_query($conn, $query400); 	

while($line = mysqli_fetch_assoc($results_the_data400)){
	$the_data400[] = $line;
}	

$n_of_vis = 0;

$sql = "select count(1) n_vis
			from businesslog_logins_rep";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$n_of_vis = $row["n_vis"];


$n_of_uniq_vis = 0;

$sql = "select count(distinct ip_addr) n_uniq_vis
			from businesslog_logins_rep
			where datex >= (now() + INTERVAL 10 HOUR - INTERVAL 30 DAY)";														
$result = $conn->query($sql);
$row = $result->fetch_assoc();			
$n_of_uniq_vis = $row["n_uniq_vis"];


$n_products = 0;

$sql = "select count(1) n_products from products where status='1'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$n_products = $row["n_products"];


$n_feedbacks = 0;

$sql = "select count(1) n_feedbacks from feedbacks where status='1'";														
$result = $conn->query($sql);
$row = $result->fetch_assoc();			
$n_feedbacks = $row["n_feedbacks"];


$conn->close();		

echo json_encode(array( "the_data1" =>  $the_data1,  
						"the_data2" =>  $the_data2, 
						"the_data3" =>  $the_data3, 
						"the_data4" =>  $the_data4, 
						"the_data10" =>  $the_data10, 
						"the_data400" =>  $the_data400,
						"n_of_vis" => $n_of_vis,
						"n_of_uniq_vis" => $n_of_uniq_vis,
						"n_products" => $n_products,
						"n_feedbacks" => $n_feedbacks));

?>
