<?php
include("../connection.php");

if(isset($_REQUEST['country_id']))
{ 	
	echo $country_id= $_REQUEST['country_id'];
}
if(isset($_REQUEST['state_id']))
{ 
	echo $state_id=$_REQUEST['state_id'];
}

if($country_id>0){
$state ="select * from states where country_id ='$country_id'";

$query_run=mysqli_query($conn,$state);

while($state_row= mysqli_fetch_assoc($query_run)){
	 //print_r($state_row); die;
	$state_data = $state_row['id'];
	$state_name = $state_row['name'];
	echo "<option value= '$state_data' > $state_name </option>";
}
}
//die;

if($state_id>0){
	echo $city="select * from cities where state_id ='$state_id'";

	$query_city_run=mysqli_query($conn,$city);

while($city_row=mysqli_fetch_assoc($query_city_run)){
	$city_id = $city_row['id'];
	$city_name = $city_row['name'];
	echo "<option value= '$city_id' > $city_name </option>";
}
}


?>