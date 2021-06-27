 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Change pasword</title>
 </head>
 <body>

 	<?php

    // header file.
    include('../View/header.html');

 	session_start();
 	$s_id = $_SESSION['s_id'];
 	$s_pass = $_SESSION['s_pass'];
 	$failed = "";
 	$flag = false;
 	$changePassSuccess = "";
 	$changePassFail = "";

 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{

 		if(empty($f_pass = basic_validation($_POST['NewPassword']))) $flag = true;
 		if(empty($f_oldPass = basic_validation($_POST['OldPassword']))) $flag = true;
 		if(empty($f_newPass = basic_validation($_POST['NewPasswordAgain']))) $flag = true;


 		if($f_pass != $f_newPass and flag)
 		{	
 			$failed = "Password dose not match";
 		}
 		else
 		{
 			if($s_pass == $f_oldPass)
 			{
 				// fetch password from json file. and update.
 				$fetch_data = json_decode(file_get_contents("../Model/signup_info.json"));

 				foreach ($fetch_data as $key )
 				{
                     if($key->Username ==  $s_id and $key->Password ==  $s_pass)
                     {
                         $key->Password = $f_newPass;

                     }
                 }
				 // save it to json file
                 $res = write($fetch_data);
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

 	// write in  .json
 function write($content)
 { 
    $content = json_encode($content);

    $filePointer = fopen("../Model/signup_info.json", "w");	
    $status = fwrite($filePointer, $content."\n");

    fclose($filePointer);
    return $status;


}

?>



<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">

 <h3>
    <fieldset>
       <legend>Change Password:</legend>

       <label for="Password">Password:<span style="color: red"><?php echo "*"; ?></span></label>
       <input type="Password" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
       <br>

       <label for="Password">Password:<span style="color: red"><?php echo "*"; ?></span></label>
       <input type="Password" id="NewPassword" name="NewPassword" placeholder="New Password" required>
       <span style="color: red"><?php echo $failed; ?></span>
       <br>

       <label for="PasswordAgain">Password:<span style="color: red"><?php echo "*"; ?></span></label>
       <input type="Password" id="NewPasswordAgain" name="NewPasswordAgain" placeholder="Re-Enter New Password" required><br>



   </fieldset>



   <br>
   <input type="submit" value="Change Pasword">

   <span style="color: green"><?php echo $changePassSuccess; ?></span>
   <span style="color: red"><?php echo $changePassFail; ?></span>
   <span style="color: green"><?php echo "<br><br><br>click here to <a href = 'welcome.php'>Go Back</a>" ?></span>



</h3>


</form>

<?php
// footer file.
include('../View/footer.html');
?>

</body>
</html>