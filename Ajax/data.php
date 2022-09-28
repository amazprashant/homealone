<?php

include("../connection.php");

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
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
</head>
<body>

<div class="container">
  <h2>Form control: select</h2>
  <p>The form below contains two dropdown menus (select lists):</p>
  <form action="" method="post">
    <div class="form-group">
      <select class="form-control" id="country-dropdown" name="country" onchange="getstate(this.value);">
      	
        <option value="" >Select Country</option>
        <?php 
        $sql_country="select * from countries";
        	$country=mysqli_query($conn,$sql_country);

        	while($country_row=mysqli_fetch_assoc($country)) {
        ?>
        <option value="<?php echo $country_row['id'];?>"><?php echo $country_row['name'];?></option>
        <?php }?>
      </select>
      <br>
     <div class="form-group">
		<label for="state">State</label>
		<select class="form-control" id="state-dropdown" name="state" onchange="getcity(this.value);">
       <option value="" >Select State</option>
		</select>
		</div>
      <br>
    <div class="form-group">
		<label for="city">City</label>
		<select class="form-control" id="city-dropdown">
		</select>
		</div>
      <br>
      <!-- <label for="sel2">Mutiple select list (hold shift to select more than one):</label>
      <select multiple class="form-control" id="sel2">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select> -->
      <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                  <h6 class="mb-0 me-4">Gender: </h6>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                      value="option1" />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                      value="option2" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                  <div class="form-check form-check-inline mb-0">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender"
                      value="option3" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

      </div>

      <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Upload CV</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input class="form-control form-control-lg" id="formFileLg" type="file" />
                <div class="small text-muted mt-2">Upload your CV/Resume or any other relevant file. Max file
                  size 50 MB</div>

              </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
	function getstate(val)
   {

       var country_id = val;
       
           $.ajax({
               type:'POST',
               url:'states-by-country.php',
               data:
               {
                   country_id:country_id,
               },
               success: function(data){
                   console.log(data)               
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
</script>

</body>
</html>

