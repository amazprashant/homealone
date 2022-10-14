<?php
session_start();
include("../connection.php");
/* $_SESSION['usertype']="sakshi_singh"; */
if($_SESSION['usertype'] !="sakshi_singh"){
?>
<script>
    location="index.php";
</script>
<?php }
?>