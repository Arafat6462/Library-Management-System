 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Change pasword</title>
   <link rel="stylesheet" href="../View/css/changepassword.css?v <?php echo time(); ?>">

 </head>
 <body>
      


 	<?php

    // header file.
    $page = 'changepassword';
    include('../View/header.php');
    include('../Model/dbupdatepassword.php');

 	session_start();
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






  <script>

    function jsValid() 
    { 
        const form = document.getElementById('form'); // full form
        const OldPassword = document.getElementById('OldPassword');
        const NewPassword = document.getElementById('NewPassword');
        const NewPasswordAgain = document.getElementById('NewPasswordAgain');
        
 
         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            //get the value from inputs.

            const  OldPasswordValue = OldPassword.value.trim();   
            const  NewPasswordValue = NewPassword.value.trim();   
            const  NewPasswordAgainValue = NewPasswordAgain.value.trim();   
           

            if (OldPasswordValue === ''){
                //show error
                // add error class
                setErrorFor(OldPassword,'Password cannot be blank');
                flag = false;
            }
            else if(OldPasswordValue.length > 15){
                setErrorFor(OldPassword,'Password cannot be > 15 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(OldPassword);
            }



            if (NewPasswordValue === ''){
                setErrorFor(NewPassword,'New Password cannot be blank');
                flag = false;
            }
            else if(NewPasswordValue.length > 15) {
                setErrorFor(NewPassword,'New Password cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(NewPassword);



            if (NewPasswordAgainValue === ''){
                setErrorFor(NewPasswordAgain,'Re-Enter Password cannot be blank');
                flag = false;
            }
            else if(NewPasswordAgainValue.length > 15) {
                setErrorFor(NewPasswordAgain,'Re-Enter Password cannot be > 15 character');
                flag = false;
            }
            else if(NewPasswordAgainValue !== NewPasswordValue) {
                setErrorFor(NewPasswordAgain,'Password does not match');
                flag = false;
            }
            else setSuccessFor(NewPasswordAgain);
 
         
          }

         function setErrorFor(input, message)
         {
            const formControl = input.parentElement; // .form-control
            const small = formControl.querySelector('small');

            // add error message inside small
            small.innerText = message;

            // add error class
            formControl.className = 'form-control error';
         } 

         function setSuccessFor(input)
         {
            const formControl = input.parentElement; // .form-control
         
            // add success class
            formControl.className = 'form-control success';
         }

         return flag;
         
    }
 
    
  </script>


<?php
// footer file.
include('../View/footer.html');
?>

</body>
</html>