<?php
   include("dbconnect.php");
   //print_r($_SESSION);
   //die;
   $session_usertype = $_SESSION['usertype'];
   $session_username = $_SESSION['username'];
   $msg12=$session_username." loves ".$session_usertype;
   print_r($msg12);
   $request_id =0;
   if(isset($_REQUEST["updateid"]))
   $request_id = $_REQUEST["updateid"];
   $data_name_data="";
   $data_mobile_data="";   
   $data_country_id= 0;
   $data_state_id= 0;
   $data_city_id= 0;
   $data_image_data = 0;   
   
   if(isset($_POST['submit']))
   {
     // print_r($_POST);die;
     /*  echo "<pre>";
      print_r($_FILES); */
     // die;
     $uploadfolder="images";
     $country_id = $_POST['country'];
     $state_id = $_POST['state'];
     $city_id=$_POST['city'];
     $name=$_POST['name'];
     $mobile_no=$_POST['mobile_no'];
   /* ////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
                                         Upload Images
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
     function getmixedno($totalchar)
   {
   	$abc= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
   	$mixedno = "";
   	for($i=1; $i<=$totalchar; $i++)
   	{
   		 $mixedno .= $abc[rand(0,33)];//ex:-A5W6Q4
   	}
    
   	return $mixedno;
   }
     // To upload a file with selected extentions only //
     function fileupload($controlname, $extention, $convert=false, $width, $height, $uploadfolder)
     {
       $uploadfolder = trim($uploadfolder,"/"); 
       if(isset($_FILES[$controlname]['tmp_name']))
       {
         if($_FILES[$controlname]['error']!=4)
         {
           //$date = new DateTime();
           $timestamp = date('U');
           $swatch = date('B');
           $now = $timestamp.$swatch;
           
           $fname=$_FILES[$controlname]['name'];
           $tm="oc";
           $tm.= $now.strtolower(getmixedno(1));
           $ext = pathinfo($fname, PATHINFO_EXTENSION);
           $ext = strtolower($ext);
           $fname=$tm.".".$ext;
           
           $arrext = explode(",",$extention);
           if(in_array($ext,$arrext))
           {
             if(move_uploaded_file($_FILES[$controlname]['tmp_name'],"$uploadfolder/$fname"))
             {
               if($convert==true)
               {
                 if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png'){
                 $this->convert_image($fname,"$uploadfolder/","$width","$height");}
               }
               return $fname;
             }
             else
             return 0;
           }
           else
           return 0;
         }
       }
       else
       return 0;
     }
   		 
   
    $image_name = fileupload('file_uploads', "jpg,jpeg" , false, 0 , 0 , $uploadfolder);     
    $password= getmixedno(8);
    //echo $password;
    $encrpt_pass=md5($password);
    //die;
   /* ////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
                                        Upload Images
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
   
   
   if($request_id == 0)
   {
    $sql_check_mobile="SELECT * FROM dependent where mobile_no='$mobile_no'";
    $run_check_mobile=mysqli_query($conn,$sql_check_mobile);
    $cnt=mysqli_num_rows($run_check_mobile);
    
      if($cnt>0)
      { ?>
          <script>
            alert("Mobile no exists");
            location="data.php";
          </script>
      <?php
       } 
       else
       {     
   
          $sql_insert= "INSERT INTO `dependent`(`name`,`mobile_no`,`country_id`, `state_id`, `city_id` ,`images` ,`password`,`salt`) VALUES ('$name','$mobile_no','$country_id','$state_id','$city_id','$image_name','$encrpt_pass','$password')";
          $insert_query_run= mysqli_query($conn,$sql_insert);
              if($insert_query_run>0)
              { ?>
                  <script>alert("RECORD INSERTED SUCCESSFULLY");
                    location="data.php";
                  </script>
          <?php }
          }
   }
   else
   {
    $get_image_data="SELECT images FROM dependent where id=$request_id";
    $get_image_run=mysqli_query($conn,$get_image_data);
    $img_fetch=mysqli_fetch_array($get_image_run)[0];  
    if($image_name=="")
       {
         $image_name=$img_fetch;
       }
   
   $sql_update= "UPDATE `dependent` SET `name`='$name',`mobile_no`='$mobile_no',`country_id`='$country_id',`state_id`='$state_id',`city_id`='$city_id',`images`='$image_name' WHERE  id=$request_id";
   $update_query_run= mysqli_query($conn,$sql_update);
   if($update_query_run>0)
   { ?>
<script>alert("RECORD UPDATED SUCCESSFULLY");
   location="data.php";
</script>
<?php 
   }
   
   }
   }
   

   if(isset($_REQUEST["updateid"])>0){
    
   
   $get_dropdown= "SELECT * FROM dependent where id = $request_id ";
   
   $run_get_dropdown=mysqli_query($conn,$get_dropdown);
   
   while($run_the_data=mysqli_fetch_assoc($run_get_dropdown)){
    // print_r($run_the_data);
    $data_name_data = $run_the_data["name"];
    $data_mobile_data = $run_the_data["mobile_no"];
     $data_country_id= $run_the_data["country_id"];
     $data_state_id= $run_the_data["state_id"];
    $data_city_id= $run_the_data["city_id"];
    $data_image_data = $run_the_data["images"];
      
   }
   
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
   </head>
   <body>
      <div class="container">
      <a href="logout.php" class ="btn btn-primary">Logout</a>
         <h2>Form control: select</h2>
         <p>The form below contains two dropdown menus (select lists):</p>
         <p id="demo"></p>
         <form action="" method="post" id="form"  enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Name</label>
               <input type= "text" class="form-control" id="name" name="name" value="<?php echo $data_name_data; ?>" >
            </div>
            <br>
            <div class="form-group">
               <label for="mobile_no">Mobile no</label>
               <input type= "text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $data_mobile_data; ?>" >
            </div>
            <br>
            <div class="form-group">
               <label for="country">Country</label>
               <select class="form-control" id="country-dropdown" name="country" onchange="getstate(this.value);">
                  <option value=0 >Select Country</option>
                  <?php 
                     $sql_country="select * from countries";
                     	$country=mysqli_query($conn,$sql_country);
                     
                     	while($country_row=mysqli_fetch_assoc($country)) {
                     ?>
                  <option value="<?php echo $country_row['id'];?>"><?php echo $country_row['name'];?></option>
                  <?php }?>
               </select>
               <script>
                  document.getElementById('country-dropdown').value="<?php echo $data_country_id ;?>";
               </script>
               <br>
               <div class="form-group">
                  <label for="state">State</label>
                  <select class="form-control" id="state-dropdown" name="state" onchange="getcity(this.value);">
                     <option value=0 >Select State</option>
                  </select>
                  <script>
                     document.getElementById('state-dropdown').value="<?php echo $data_state_id ;?>";
                  </script>
               </div>
               <br>
               <div class="form-group">
                  <label for="city">City</label>
                  <select class="form-control" id="city-dropdown"name="city">
                     <option value=0 >Select City</option>
                  </select>
                  <script> 
                     document.getElementById('city-dropdown').value="<?php echo $data_city_id ;?>";
                  </script>
               </div>
               <br>
               <div class="form-group">
                  <label for="File_Upload">File Upload</label>
                  <input type= "file" class="form-control" id="images" name="file_uploads" onChange="readURL1(this);" >
                  <img src="images\<?php echo $data_image_data;?>" id="img" style="width:100px; height:100px;"/>
               </div>
            </div>
            <?php if($request_id >0)
               { ?>
            <!-- <input type="submit" value="Update" onclick="myUpdateFunction(<?php  echo $request_id;?>)"><br>-->
            <input type="submit" value="Update" name="submit" ><br>
            <?php } else{ ?> 
            <input type="submit" name ="submit" value="Submit"><br>
            <?php } ?>
         </form>
      </div>
            </br>
            
        <h2 class='mb-3'>Basic example</h2>
        <?php 
        if(isset($_REQUEST['search']))
        {
          extract($_POST);
          print_r($_POST);
          $crit="";

          if($name !=""){
            $crit.="and dependent.name LIKE '%$name%'";
          }
          if($mobile_no !=""){
            $crit.="and dependent.mobile_no ='$mobile_no'";
          }
          if($country !=""){
            $crit.="and dependent.country_id ='$country'";
          }
          if($state !=""){
            $crit.="and dependent.state_id ='$state'";
          }
          if($city !=""){
            $crit.="and dependent.city_id ='$city'";
          }
        }
        ?>
        <table >
          <form action="" method="POST">

          <div class="form-group">
      <td style="padding-right:10px;"><input type="text" name="name" value="" placeholder="NAME" style="width:140px;" /></td>
      <td style="padding-right:10px;"><input type="text" name="mobile_no" value="" placeholder="Mobile Number" style="width:140px;" /></td>
      	<td style="padding-right:10px;"><select class="form-control" id="country-dropdown" name="country">
                  <option value=0 >Select Country</option>
                  <?php 
                     $sql_country="select * from countries";
                     	$country=mysqli_query($conn,$sql_country);
                     
                     	while($country_row=mysqli_fetch_assoc($country)) {
                     ?>
                  <option value="<?php echo $country_row['id'];?>"><?php echo $country_row['name'];?></option>
                  <?php }?>
               </select></td>
        <td style="padding-right:10px;">
               <select class="form-control" id="state-dropdown" name="state">
                  <option value= >Select State</option>
                  <?php 
                     echo $sql_state="select * from states";
                     	$state_dropdown_run=mysqli_query($conn,$sql_state);
                     
                     	while($state_row=mysqli_fetch_assoc($state_dropdown_run)) {
                     ?>
                  <option value="<?php echo $state_row['id'];?>"><?php echo $state_row['name'];?></option>
                  <?php }?>
               </select>
          </td>
          <td style="padding-right:10px;"><select class="form-control" id="city-dropdown" name="city" >
                  <option value= >Select city</option>
                  <?php 
                     $sql_city="select * from cities";
                     	$city=mysqli_query($conn,$sql_city);
                     
                     	while($city_row=mysqli_fetch_assoc($city)) {
                     ?>
                  <option value="<?php echo $city_row['id'];?>"><?php echo $city_row['name'];?></option>
                  <?php }?>
               </select>
          </td>
      
        <td style="padding-right:10px;"><input type="submit" name ="search" value="Search"></td>
        <td style="padding-right:10px;"><a href="data.php" class ="btn btn-primary" value="Search">Add</a></td>
        
      
      </div>

          </form>
        </table>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>Id</th>
               <th>Name</th>
               <th>Mobile</th>
               <th>Country</th>
               <th>State</th>
               <th>City</th>
               <th>Images</th>
               <th>Action
            </tr>
         </thead>
         <tbody>
            <?php
               $count=1;
               
                  echo  $get_data="SELECT dependent.id,dependent.name ,dependent.mobile_no,dependent.images ,countries.name as country_name ,states.name as state_name,cities.name as city_name FROM dependent
                   LEFT JOIN countries ON dependent.country_id=countries.id
                   LEFT JOIN states ON dependent.state_id=states.id
                   LEFT JOIN cities ON dependent.city_id=cities.id
                   WHERE 1  
                   $crit
                   ORDER BY countries.name";
               
                   $data_run=mysqli_query($conn,$get_data);
                   while($rowdata=mysqli_fetch_assoc($data_run))
                   {
                      // print_r($rowdata);
                       ?>
            <tr>
               <td><?php echo $count;?></td>
               <td><?php echo $rowdata['name'];?></td>
               <td><?php echo $rowdata['mobile_no'];?></td>
               <td><?php echo $rowdata['country_name'];?></td>
               <td><?php echo $rowdata['state_name'];?></td>
               <td><?php echo $rowdata['city_name'];?></td>
               <td> <img src="images\<?php echo $rowdata['images'];?>" style="width:100px; height:100px;"/></td>
               <td><a href="data.php?updateid=<?php echo $rowdata['id'];?>" class="btn btn-info">Update</a>
                  <a onclick="myFunction(<?php echo $rowdata['id'];?>)" class="btn btn-danger">Delete</a>
               </td>
            </tr>
            <?php $count++; }
               ?>
         </tbody>
      </table>
      <script type="text/javascript">
         function getstate(val)
           {
           // var selectedValue = document.getElementById("country-dropdown").value;
               var country_id = val;
               
                   $.ajax({
                       type:'POST',
                       url:'states-by-country.php',
                       data:
                       {
                           country_id:country_id,
                       },
                       success: function(data){
                           //console.log(data)               
                            $("#state-dropdown").html(data);             
           
                       }
               });
           }
           function getcity(cities)
           {
           	 var state_id = cities;
           	 $.ajax({
           	 	type:'POST',
           	 	url:'states-by-country.php',
           	 	data:
           	 	{
           	 		state_id: state_id,
           	 	},
           	 	success:function(data){
           	 		$("#city-dropdown").html(data);
           	 	}
           	 })
           }
          var update_id= <?php echo $request_id; ?>;
          //console.log(update_id);
          if(update_id>0){
            //alert(update_id);
            var update_state_id= <?php echo $data_country_id; ?>;
            var update_city_id= <?php echo $data_state_id; ?>;
            getstate(update_state_id);
            getcity(update_city_id);
            
            
          }
           
      </script>
      <script>
         function myFunction(data1) {
           let text = "Are you sure . You want to delete this data";
           if (confirm(text) == true) {
             text = "Deleted successfully!";
             $.ajax({
                        type:'POST',
                        url:'delete_ajax.php',
                        data:
                        {
                            delete_data:data1,
                        },
                        success: function(data){
                            //console.log(data)
                            //document.getElementById("demo").innerHTML = data; 
                            alert(data);              
                                         
            
                        }
                });
         
           } else {
             text = "Data not  Deleted!";
           }
           
         }
         
      </script> 
      <script>
                                              function readURL1(input) {
                                                var fuData = document.getElementById('images');
                                                var FileUploadPath = fuData.value;
                                                if (FileUploadPath == '') {
                                                    alert("Please upload an image");
                                                } else {
                                                    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                                              if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                                                            || Extension == "jpeg" || Extension == "jpg") {
                                            const fi = document.getElementById('images');
                                                   // Check if any file is selected.
                                                   if (fi.files.length > 0) {
                                                       for (const i = 0; i <= fi.files.length - 1; i++) {
                                                           const fsize = fi.files.item(i).size;
                                                           const file = Math.round((fsize / 2048));
                                                           // The size of the file.
                                                           if (file >= 2048) {
                                                               alert(
                                                                 "File too Big, please select a file less than 2 MB");
                                                                 document.getElementById('images').value='';
                                                           } else {
                                                               if (fuData.files && fuData.files[0]) {
                                                           var reader = new FileReader();
                                                           reader.onload = function(e) {
                                                               $('#img').attr('src', e.target.result); 
                                                           }
                                                           reader.readAsDataURL(fuData.files[0]);
                                                       }
                                                           }
                                                       }
                                                   }
                                                    }

                                              else {
                                                        alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                                                        document.getElementById('images').value='';
                                                    }
                                                }
                                              if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                reader.onload = function(e) {
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                                }
                                              }

                                            </script> 
            <script>
              $("#demo").click(function () {

$("#section_one").show();
$("#section_two").hide();
});
$("#header2").click(function () {

$("#section_two").show();
$("#section_one").hide();

});
            </script>   
   </body>
</html>