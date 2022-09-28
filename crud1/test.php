<?php 
include("connection.php");



if(isset($_REQUEST['id'])){
$get_id=$_REQUEST['id'];
}else{
  $get_id=0;  
}

if(isset($_POST['submit']))
{
    /*echo"<pre>";
    print_r($_POST);
    echo"</pre>";*/
    //die;
    

    $firstname=$_POST['firstname'];
    $color=$_POST['color'];
    $sport=$_POST['sport'];
    $Startdate=$_POST['Startdate'];
    $Enddate=$_POST['Enddate'];
    $email=$_POST['email'];
    $telephone=$_POST['telephone'];
    $image="";
    $status= 1;
    $create_date= date("Y-m-d h:i:s");
    

    
    
//die;
    //echo $get_data;
    if($get_id==0){

    //INSERT 
    $insert_query= "INSERT INTO `crud`(`firstname`, `color`, `sport`, `Startdate`, `Enddate`, `email`, `telephone`, `image`, `status`, `create_date`) VALUES ('$firstname','$color','$sport','$Startdate','$Enddate','$email',' $telephone','$image','$status','$create_date')";

                $insert_run=mysqli_query($conn,$insert_query);
                if($insert_run>0){
                echo "<script>alert('Record inserted successfully');
                location='test.php';
                
                </script>";
               }
           }
               else
               {
    //UPDATE

    echo $update_query="UPDATE `crud` SET `firstname`='$firstname',`color`='$color',`sport`='$sport',`Startdate`='$Startdate',`Enddate`='$Enddate',`email`='$email',`telephone`='$telephone',`image`='$image',`status`='$status',`update_date`='$create_date' where id='$get_id'";
               $update_run=mysqli_query($conn,$update_query);
                if($update_run>0){
                echo "<script>alert('Record Updated successfully');
                location='test.php';
                
                </script>";
               }
}
}

    //DELETE
if(isset($_REQUEST['delete_id'])){
    $delete_id=$_REQUEST['delete_id'];
   echo $delete_query="DELETE FROM `crud` where id='$delete_id'"; 
   $delete_run=mysqli_query($conn,$delete_query);
                    if($delete_run>0){
                echo "<script>alert('Record Delete successfully');
                location='test.php';
                
                </script>";
               }
           }


if($get_id>0){
    $request_id="select * from crud where id= '$get_id'";
    $request_run=mysqli_query($conn,$request_id);
    $fetch_array=mysqli_fetch_assoc($request_run);


    print_r($fetch_array);
    $snum=$fetch_array['firstname'];
    $snum1=$fetch_array['color'];
    $snum2=$fetch_array['sport'];
    $snum3=$fetch_array['Startdate'];
    $snum4=$fetch_array['Enddate'];
    $snum5=$fetch_array['email'];
    $snum6=$fetch_array['telephone'];

    if($snum1==="red"){
        $checked="checked = 'checked' ";
    }elseif($snum1=="blue"){
        $checked="checked = 'checked' ";
    }elseif($snum1=="green"){
        $checked="checked = 'checked' ";
    }elseif($snum1=="pink"){
        $checked="checked = 'checked' ";
    }else{
        $checked="";
    }
}else{
    $snum="";
    $snum1="";
    $snum2="";
    $snum3="";
    $snum4="";
    $snum5="";
    $snum6="";

}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    
</head>
<body>
<?php
//print_r($get_id);
?>
<form action="" method="get" enctype="multipart/form-data" >  
    <label>Enter first name</label><br>  
    <input type="text" name="firstname" value="<?php echo $snum; ?>"><br>  

         <p>Kindly Select your favorite color</p>  
      <input type="radio" name="color" value="red" <?php if($snum1=="red"){?>

        checked = "checked" 
    <?php  } else{

    } 
            ?>> red <br>  
      <input type="radio" name="color" value="blue" <?php if($snum1=="blue"){?>

        checked = "checked" 
    <?php  }  
            ?>> blue <br>  
      <input type="radio" name="color" value="green" <?php if($snum1=="green"){?>

        checked = "checked" 
    <?php  }  
            ?>>green <br>  
      <input type="radio" name="color" value="pink"<?php if($snum1=="pink"){?>

        checked = "checked" 
    <?php  }  
            ?>>pink <br> 

      <p>Kindly Select your favourite sports</p> 

      <input type="checkbox" name="sport" value="cricket" <?php if($snum2=="cricket"){?>

        checked = "checked" 
    <?php  }  
            ?>>Cricket<br>  
      <input type="checkbox" name="sport" value="tennis" <?php if($snum2=="tennis"){?>

        checked = "checked" 
    <?php  }  
            ?>>Tennis<br>  
      <input type="checkbox" name="sport" value="football"<?php if($snum2=="football"){?>

        checked = "checked" 
    <?php  }  
            ?>>Football<br>  
      <input type="checkbox" name="sport" value="baseball" <?php if($snum2=="baseball"){?>

        checked = "checked" 
    <?php  }  
            ?>>Baseball<br>  
      <input type="checkbox" name="sport" value="badminton" <?php if($snum2=="badminton"){?>

        checked = "checked" 
    <?php  }  
            ?>>Badminton<br>

      <h2>Input "image" type.</h2>   
          <label for="img">Select image:</label>
          <input type="file" id="img" name="img" accept="image/*">
          <br>
       Select Start and End Date: <br><br>  
      <input type="date" name="Startdate" value="<?php echo $snum3; ?>"> Start date:<br><br>  
      <input type="date" name="Enddate" value="<?php echo $snum4; ?>"> End date:<br><br>  

      <label><b>Enter your Email-address</b></label>  
        <input type="email" name="email" value="<?php echo $snum5; ?>" required>  
        <br>
     <label><b>Enter your Telephone Number(in format of xxx-xxx-xxxx):</b></label>  
      <input type="tel" name="telephone"  value="<?php echo $snum6; ?>"required>  
      <br> 
      <input type="submit" name ="submit" value="Submit"><br>  
</form> 
<h2 class='mb-3'>Basic example</h2>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Color</th>
                <th>Sport</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Action

            </tr>
        </thead>
        <tbody>
            <?php
            $count=1;

                $get_data="select * from crud";

                $data_run=mysqli_query($conn,$get_data);
                while($rowdata=mysqli_fetch_assoc($data_run))
                {
                   // print_r($rowdata);
                    ?>
<tr>
                <td><?php echo $count;?></td>
                <td><?php echo $rowdata['firstname'];?></td>
                <td><?php echo $rowdata['color'];?></td>
                <td><?php echo $rowdata['sport'];?></td>
                <td><?php echo $rowdata['Startdate'];?></td>
                <td><?php echo $rowdata['Enddate'];?></td>
                <td><?php echo $rowdata['email'];?></td>
                <td><?php echo $rowdata['telephone'];?></td>
                <td><a href="test.php?id=<?php echo $rowdata['id'];?>" class="btn btn-info">Update</a>
                <a href="test.php?delete_id=<?php echo $rowdata['id'];?>" class="btn btn-danger">Delete</a>
            </td>
            </tr>
               <?php $count++; }

            ?>
            
            
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Color</th>
                <th>Sport</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Action
            </tr>
        </tfoot>
    </table>
<script>
 $(document).ready(function () {
    $('#example').DataTable();
});
</script>
    </body>
</html>