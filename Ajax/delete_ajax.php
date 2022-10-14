<?php
include("../connection.php");

if(isset($_REQUEST['delete_data']))
{ 	
	$delete_record= $_REQUEST['delete_data'];
}

$delete_sql="Delete FROM dependent where id = $delete_record";

$delete_run_query= mysqli_query($conn,$delete_sql);

if($delete_run_query>0){
 echo "Deleted successfully";
}
?>