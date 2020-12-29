<?php 
 session_start();
 if(isset($_POST["submit"]))
 {
     if(($_POST['emailid']=='abc@gmail.com') && ($_POST['password']=='12345'))
     {
     
      $_SESSION["email"]=$_POST['emailid'];

      header("location:getdata.php");
     }
     else{
      $_SESSION["error"]='Invalid Email and Password';
      header("location:loginform.php");
     }
  } 


?>