 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Sign-Up</title>
    <link rel="stylesheet" href="../View/css/signup.css?v <?php echo time(); ?>">
    <script src="../View/js/signup.js"></script>

 </head>
 <body>

 
 	<?php
  include '../Model/dbregistration.php';  

 	$signupSuccess = "";
  $signupFailed = "";
  $Password_not_match = "";
  $isValid = true;

  $Firstname = "";
  $Lastname = "";
  $Gender = "";
  $DOB = "";
  $Religion = "";
  $Present_Address = "";
  $Permanent_Address = "";
  $Phone = "";
  $Email = "";
  $Website = "";
  $Username = "";
  $Password = "";
  $PasswordAgain = "";

  $FirstnameErr = $LastnameErr = $GenderErr = $DOBErr = "";
  $ReligionErr = $Present_AddressErr = $Permanent_AddressErr = $PhoneErr = "";
  $EmailErr = $WebsiteErr = $UsernameErr = $PasswordErr = $PasswordAgainErr = "";
 


 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{
	 
            $Firstname = $_POST['Firstname'];
            $Lastname = $_POST['Lastname'];
            $Gender = $_POST['Gender'];
            $DOB = $_POST['DOB'];
            $Religion = $_POST['Religion'];
            $Present_Address = $_POST['Presentaddress'];
            $Permanent_Address = $_POST['Permanentaddress'];
            $Phone = $_POST['Phone'];
            $Email = $_POST['Email'];
            $Website = $_POST['Website'];
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];
            $PasswordAgain = $_POST['PasswordAgain'];

             if(empty($Firstname))
               {
                  $FirstnameErr = "Firstname can not be empty.";
                  $isValid = false;
               }
             if(strlen($Firstname) > 15)
                {
                  $FirstnameErr = "Firstname can not be > 15 Character..";
                  $isValid = false;
               }

             if(empty($Lastname))
               {
                  $LastnameErr = "Lastname can not be empty.";
                  $isValid = false;
               }
            if(strlen($Lastname) > 15)
                {
                  $LastnameErr = "Lastname can not be > 15 Character..";
                  $isValid = false;
               }

             if(empty($Gender))
               {
                  $GenderErr = "Gender can not be empty.";
                  $isValid = false;
               }
            if(strlen($Gender) > 10)
                {
                  $GenderErr = "Gender can not be > 10 Character..";
                  $isValid = false;
               }
               

             if(empty($DOB))
               {
                  $DOBErr = "DOB can not be empty Character.";
                  $isValid = false;
               }

             if(empty($Religion))
               {
                  $ReligionErr = "Religion can not be empty or > 15 Character.";
                  $isValid = false;
               }
            if(strlen($Religion) > 15)
                {
                  $ReligionErr = "Religion can not be > 15 Character..";
                  $isValid = false;
               }


             if( strlen($Present_Address) > 100)
               {
                  $Present_AddressErr = "presentaddress can not be > 100 Character.";
                  $isValid = false;
               }
             if( strlen($Permanent_Address) > 100)
               {
                  $Permanent_AddressErr = "Permanentaddress can not be > 100 Character.";
                  $isValid = false;
               }

             if(empty($Phone))
               {
                  $PhoneErr = "phone can not be empty or > 15 Character.";
                  $isValid = false;
               }
            if( strlen($Phone) > 15)
                {
                  $PhoneErr = "Phone can not be > 15 Character..";
                  $isValid = false;
               }

             if(empty($Email))
               {
                  $EmailErr = "Email can not be empty or > 30 Character.";
                  $isValid = false;
               }
               if(strlen($Email) > 30)
                {
                  $EmailErr = "Email can not be > 30 Character..";
                  $isValid = false;
               }

             if(strlen($Website) > 50)
               {
                  $WebsiteErr = "Website can not be empty or > 50 Character.";
                  $isValid = false;
               }



             if(empty($Username))
               {
                  $UsernameErr = "Username can not be empty or > 15 Character.";
                  $isValid = false;
               }
               if(strlen($Username) > 15)
                {
                  $UsernameErr = "Username can not be > 15 Character..";
                  $isValid = false;
               }

             if(empty($Password))
               {
                  $PasswordErr = "Password can not be empty or > 15 Character.";
                  $isValid = false;
               }
                if( strlen($Password) > 15)
                {
                  $PasswordErr = "Password can not be > 15 Character..";
                  $isValid = false;
               }

               if($Password != $PasswordAgain)
                  { 
                    $PasswordAgainErr = "Password dose not match";
                    $isValid = false;
                  }
   

            // empty validation for required field
            $Firstname=basic_validation($Firstname); 
            $Lastname=basic_validation($Lastname); 
            $Gender=basic_validation($Gender); 
            $DOB=basic_validation($DOB); 
            $Religion = basic_validation($Religion);
            $Present_Address = basic_validation($Present_Address);
            $Permanent_Address = basic_validation($Permanent_Address);
            $Phone=basic_validation($Phone); 
            $Email=basic_validation($Email); 
            $Website=basic_validation($Website); 
            $Username=basic_validation($Username); 
            $Password=basic_validation($Password); 
            
            

 
            // if pass php validation then can write file.
            if($isValid)
             {
                 $res = register($Firstname,$Lastname,$Gender,$DOB,$Religion,$Present_Address,$Permanent_Address,$Phone,$Email,$Website,$Username,$Password);
              
                  if($res) 
                     {
                        $signupSuccess = "Sign-Up succesfull. Please log-in";

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

    ?>



  <!-- ///////////////////////////////////////////////// -->
  <div class="container">
        <div class="header">
            <h2>Create Account</h2>
             <a class="title" href="login.php">LIBRARY</a>

        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST" onsubmit="return jsValid();">
            <div class="form-control">
                <lable>First Name</lable>
                <input type="text" placeholder="Arafat" id="Firstname" name="Firstname" value="<?php echo $Firstname ?>" >
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $FirstnameErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Last Name</lable>
                <input type="text" placeholder="Hossain" id="Lastname" name="Lastname" value="<?php echo $Lastname ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $LastnameErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Gender</lable>
                <span style="display:flex; margin-top: 15px; margin: 0 8em; ">
                    <input type="radio"  id="Male" name="Gender" value="Male">
                    <label for="Male">Male</label>

                    <input type="radio"  id="Female" name="Gender" value="Female">
                    <label for="Female">Female</label>

                    <input type="radio"  id="Other" name="Gender" value="Other">
                    <label for="Other">Other</label>
                    <small>Error message</small>
               </span>
                    <span style="color: red"> <?php echo $GenderErr; ?> </span>
            </div>  
 

            <div class="form-control">
                <lable>DOB</lable>
                <input type="date" placeholder="3/5/1997" id="Dob" name="DOB" value="<?php echo $DOB ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $DOBErr; ?> </span>

            </div>  

            <div class="form-control">
                <lable style="display:flex;">Religion</lable>
                 <select name="Religion" id="Religion" style="font-size: 14px;">
                    <option value="">--- Select Religion ---</option>
                    <option value="Islam" name="Religion" >Islam</option>
                    <option value="Hindu" name="Religion" >Hindu</option>
                    <option value="Christian" name="Religion" >Christian</option>
                </select>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $ReligionErr; ?> </span>
            </div>  
            

             <div class="form-control">
                <lable style="display: flex;">Present Address</lable>
                <textarea id="Presentaddress" rows="2" cols="20" placeholder="Jatrabari,Dhaka" name="Presentaddress"></textarea>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $Present_AddressErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable style="display: flex;">Permanent Address</lable>
                <textarea id="Permanentaddress" rows="2" cols="20" placeholder="Faridpur,Dhaka" name="Permanentaddress"></textarea>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $Permanent_AddressErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Phone</lable>
                <input type="number" placeholder="01626789352" id="Phone" name="Phone" value="<?php echo $Phone ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $PhoneErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Email</lable>
                <input type="email" placeholder="Arafat6462@gmail.com" id="Email" name="Email" value="<?php echo $Email ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $EmailErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Personal Website</lable>
                <input type="url" placeholder="http://localhost/library" id="Website" name="Website" value="<?php echo $Website ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $WebsiteErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Username</lable>
                <input type="text" placeholder="Arafat6462" id="Username" name="Username" value="<?php echo $Username ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $UsernameErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Password</lable>
                <input type="password" placeholder="********" id="Password" name="Password" value="<?php echo $Password ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $PasswordErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Password check</lable>
                <input type="password" placeholder="********" id="PasswordAgain" name="PasswordAgain" value="<?php echo $PasswordAgain ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $PasswordAgainErr; ?> </span>
            </div>  


            <button type="submit">Submit</button>

            <span style="color: green"><?php echo "<br><br>click here to <a href = 'login.php'>Log-in</a>" ?></span>

        </form>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->

</body>
</html>