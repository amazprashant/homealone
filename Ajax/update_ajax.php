<?php 
include("../connection.php");

if(isset($_REQUEST['update_data']))
{
    $update_record=$_REQUEST['update_data'];
    $country_id=$_REQUEST['country_id'];
    $state_id=$_REQUEST['state_id'];
    $city_id=$_REQUEST['city_id'];
}
echo $update_query="UPDATE `dependent` SET `country_id`='$country_id',`state_id`='$state_id',`city_id`='$city_id',`images`='$uploadfolder' WHERE  id=$update_record";
die;
 $update_query_run = mysqli_query($conn,$update_query);

 if($update_query_run>0){
    echo"Updated Successfully";
 }

?>