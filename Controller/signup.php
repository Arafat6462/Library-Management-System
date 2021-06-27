 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Sign-Up</title>
 </head>
 <body>

 	<h1>Sign-Up Form for Librarian:</h1>

 	<?php

 	$signupSuccess = $signupFailed = "";
    $flag = false;


 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{


 		if($_POST['Password'] != $_POST['PasswordAgain'])
 		{	
 			$failed = "Password dose not match";
 		}
 		else
 		{
 			// $set_userName = $_POST['Username'];
 			// $set_password = $_POST['Password'];

			// add id,pass to file.txt
 			// echo $set_userName;
 			// echo $set_password;


            // empty validation for required field
            if(empty($Firstname=basic_validation($_POST['Firstname']))) $flag = true;
            if(empty($Lastname=basic_validation($_POST['Lastname']))) $flag = true;
            if(empty($Gender=basic_validation($_POST['Gender']))) $flag = true;
            if(empty($DOB=basic_validation($_POST['DOB']))) $flag = true;
            if(empty($phone=basic_validation($_POST['phone']))) $flag = true;
            if(empty($Email=basic_validation($_POST['Email']))) $flag = true;
            if(empty($Username=basic_validation($_POST['Username']))) $flag = true;
            if(empty($Password=basic_validation($_POST['Password']))) $flag = true;




 			$array = array( "Firstname"=>basic_validation($_POST['Firstname']),"Lastname"=>basic_validation($_POST['Lastname']),
 				"Gender"=>basic_validation($_POST['Gender']),"DOB"=>basic_validation($_POST['DOB']),
 				"Religion"=>basic_validation($_POST['Religion']),"presentaddress"=>basic_validation($_POST['presentaddress']),
 				"Permanentaddress"=>basic_validation($_POST['Permanentaddress']),"phone"=>basic_validation($_POST['phone']),
 				"Email"=>basic_validation($_POST['Email']),"linked"=>basic_validation($_POST['linked']),
 				"Username"=>basic_validation($_POST['Username']),"Password"=>basic_validation($_POST['Password']),
 			);


            // if pass php validation then can write file.
             if(!$flag)
             $res = write($array);

              // if file write successful
             if($res) 
             {
                $signupSuccess = "Sign-Up succesfull. Please log-in";

                  // pass sign up info to login by session
                session_start();
                $_SESSION['signupStatus'] = $signupSuccess;
                header("location:login.php"); 

            }

            else{ $signupFailed = "Sign-Up Failed";}


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

 		// write in data.json
    function write($content)
    {
        $signInInfo = json_decode(file_get_contents("../Model/signup_info.json"));

 			 // add new value on associative array formate data.json
        array_push($signInInfo, $content);

        $signInInfo = json_encode($signInInfo);


        $filePointer = fopen("../Model/signup_info.json", "w");	
        $status = fwrite($filePointer, $signInInfo."\n");

        fclose($filePointer);
        return $status;


    }



    ?>


    <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">



        <fieldset>
           <legend>Basic Information:</legend>

           <label for="fname">First Name:<span style="color: red"><?php echo "*"; ?></span></label>
           <input type="text" id="fname" name="Firstname" required><br>

           <label for="lname">Last name:<span style="color: red"><?php echo "*"; ?></span> </label>
           <input type="text" id="lname" name="Lastname" required><br>


           Select Gender:<span style="color: red"><?php echo "*"; ?></span><br>
           <input type="radio" id="Male" name="Gender" value="Male" required>
           <label for="Male">Male</label> <br>

           <input type="radio" id="Female" name="Gender" value="Female">
           <label for="Female">Female</label> <br>

           <input type="radio" id="Other" name="Gender" value="Other">
           <label for="Other">Other</label><br>


           <label for="DOB">DOB:<span style="color: red"><?php echo "*"; ?></span></label>
           <input type="date" id="DOB" name="DOB" required><br>

           Religion:<br>
           <select name="Religion" > 
              <option value="" name="" ></option> 
              <option value="islam" name="Religion" >islam</option> 
              <option value="hindu" name="Religion" >hindu</option> 
              <option value="christian" name="Religion" >christian</option> 
          </select>
      </fieldset>
      <br><br><br>




      <fieldset>
       <legend>Contact Information:</legend>


       <label for="presentaddress">presentaddress:</label>
       <textarea id="presentaddress" name="presentaddress" rows="2" cols="20"></textarea><br>

       <label for="Permanentaddress">Permanentaddress:</label>
       <textarea id="Permanentaddress" name="Permanentaddress" rows="2" cols="20"></textarea><br>


       <label for="phone">phone:<span style="color: red"><?php echo "*"; ?> </label>
          <input type="tel" id="phone" name="phone" required=""><br>

          <label for="Email">Email:<span style="color: red"><?php echo "*"; ?></span> </label>
          <input type="Email" id="Email" name="Email" required><br>

          <label for="linked">Personal Website linked : </label>
          <input type="url" id="linked" name="linked"><br>


      </fieldset>


      <br><br><br>


      <fieldset>
          <legend>Account Information:</legend>


          <label for="Username">Username:<span style="color: red"><?php echo "*"; ?></span></label>
          <input type="text" id="Username" name="Username" placeholder="Username" required><br>

          <label for="Password">Password:<span style="color: red"><?php echo "*"; ?></span></label>
          <input type="Password" id="Password" name="Password" placeholder="Enter Password" required>
          <span style="color: red"><?php echo $failed; ?></span>
          <br>

          <label for="PasswordAgain">Password:<span style="color: red"><?php echo "*"; ?></span></label>
          <input type="Password" id="PasswordAgain" name="PasswordAgain" placeholder="Re-Enter Password" required><br>



      </fieldset>

      <br>
      <input type="submit" value="Sign-up">

      <span style="color: red"><?php echo $signupFailed; ?></span>
      <span style="color: green"><?php echo "<br><br><br>click here to <a href = 'login.php'>login</a>" ?></span>


  </form>

</body>
</html>