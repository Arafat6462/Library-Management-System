 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Change pasword</title>
    <link rel="stylesheet" href="../View/css/changepassword.css?v <?php echo time(); ?>">
    <script src="../View/js/changepassword.js"></script>



 </head>
 <body>
      


 	<?php

    /// redirect login for no session
    session_start();
    if(!isset($_SESSION['s_id']))
        header("location:../");

    // header file.
    $page = 'changepassword';
    include('../View/html/header.php');
    include('../Model/dbupdatepassword.php');

 	// session_start();
 	$s_id = $_SESSION['s_id'];
 	$s_pass = $_SESSION['s_pass'];
 	$failed = "";
 	$isValid = true;
 	$changePassSuccess = "";
 	$changePassFail = "";

    $f_oldPassErr = "";
    $f_passErr = "";
    $f_newPassErr = "";

 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{

       $f_oldPass = $_POST['OldPassword'];
       $f_pass = $_POST['NewPassword'];
       $f_newPass = $_POST['NewPasswordAgain'];



      if(empty($f_oldPass))
       {
          $f_oldPassErr = "password can not be empty";
          $isValid = false;
       }
        if(strlen($f_oldPass) > 15)
        {
          $f_oldPassErr = "password can not be > 15 Character.";
          $isValid = false;
        }

      if(empty($f_pass))
       {
          $f_passErr = "password can not be empty";
          $isValid = false;
       }
       if(strlen($f_pass) > 15)
        {
          $f_passErr = "password can not be > 15 Character.";
          $isValid = false;
        }
       if(empty($f_newPass))
       {
          $f_newPassErr = "password can not be empty";
          $isValid = false;
       }
       if(strlen($f_newPass) > 15)
        {
          $f_newPassErr = "password can not be > 15 Character.";
          $isValid = false;
        }

     
 		 $f_oldPass = basic_validation($f_oldPass);
 		 $f_pass = basic_validation($f_pass);
 		 $f_newPass = basic_validation($f_newPass);


 		if($f_pass != $f_newPass)
 		{	
 			$failed = "Password dose not match";
 		}
 		if($isValid and $f_pass == $f_newPass)
 		{
 			if($s_pass == $f_oldPass)
 			{
              $res = updatePassword($s_id, $f_newPass);
              if($res)
              {
                 $changePassSuccess = "Change password successful.";

                  // update session pass whit change password.
                 session_start();
                 $_SESSION['s_pass'] = $f_newPass;
              }
            }

            else
             $changePassFail = "Password Incorect";

     }

 }


	// validate input
 function basic_validation($data)
 {
     $data = trim($data);
     $data = htmlspecialchars($data);
     $data = stripcslashes($data);
     return $data;
 }
 
?>

 
 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Change Password</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST" onsubmit="return jsValid();" >
            <div class="form-control">
                <lable>Password</lable>
                <input type="pasword" placeholder="OldPassword" id="OldPassword" name="OldPassword">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $f_oldPassErr; ?> </span>
            </div>  

              
            <div class="form-control">
                <lable>New Password</lable>
                <input type="password" placeholder="NewPassword" id="NewPassword" name="NewPassword">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $failed; ?> </span>
                <span style="color: red"> <?php echo $f_passErr; ?> </span>
            </div> 

             
             <div class="form-control">
                <lable>New Password</lable>
                <input type="Password" placeholder="Re-Enter New Password" id="NewPasswordAgain" name="NewPasswordAgain">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $f_newPassErr; ?> </span>
            </div> 
 
            

            

             <button type="submit" value="Change Pasword">Change Pasword</button>
             <span style="color: green;"> <?php echo $changePassSuccess; ?> </span>
             <span style="color: red"> <?php echo $changePassFail; ?> </span>

 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->

<?php
// footer file.
include('../View/html/footer.html');
?>

</body>
</html>