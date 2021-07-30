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

  $FirstnameErr = $LastnameErr = $GenderErr = $DOBErr = "";
  $ReligionErr = $Present_AddressErr = $Permanent_AddressErr = $PhoneErr = "";
  $EmailErr = $WebsiteErr = $UsernameErr = $PasswordErr = "";
 


 	if ($_SERVER['REQUEST_METHOD'] === "POST")
 	{
	 
            $Firstname = $_POST['Firstname'];
            $Lastname = $_POST['Lastname'];
            $Gender = $_POST['Gender'];
            $DOB = $_POST['DOB'];
            $Religion = $_POST['Religion'];
            $Present_Address = $_POST['Presentaddress'];
            $Permanent_Address = $_POST['Permanentaddress'];
            $Phone = $_POST['phone'];
            $Email = $_POST['Email'];
            $Website = $_POST['Website'];
            $Username = $_POST['Username'];
            $Password = $_POST['Password'];

             if(empty($Firstname) or strlen($Firstname) > 15)
               {
                  $FirstnameErr = "Firstname can not be empty or > 15 Character.";
                  $isValid = false;
               }
             if(empty($Lastname) or strlen($Lastname) > 15)
               {
                  $LastnameErr = "Lastname can not be empty or > 15 Character. Character.";
                  $isValid = false;
               }
             if(empty($Gender) or strlen($Gender) > 10)
               {
                  $GenderErr = "Gender can not be empty or > 10 Character.";
                  $isValid = false;
               }
             if(empty($DOB))
               {
                  $DOBErr = "DOB can not be empty Character.";
                  $isValid = false;
               }
             if(empty($Religion) or strlen($Religion) > 15)
               {
                  $ReligionErr = "Religion can not be empty or > 15 Character.";
                  $isValid = false;
               }
             if( strlen($Present_Address) > 100)
               {
                  $Present_AddressErr = "presentaddress can not be empty or > 100 Character.";
                  $isValid = false;
               }
             if( strlen($Permanent_Address) > 100)
               {
                  $Permanent_AddressErr = "Permanentaddress can not be empty or > 100 Character.";
                  $isValid = false;
               }
             if(empty($Phone) or strlen($Phone) > 15)
               {
                  $PhoneErr = "phone can not be empty or > 15 Character.";
                  $isValid = false;
               }
             if(empty($Email) or strlen($Email) > 30)
               {
                  $EmailErr = "Email can not be empty or > 30 Character.";
                  $isValid = false;
               }
             if(strlen($Website) > 50)
               {
                  $WebsiteErr = "Website can not be empty or > 50 Character.";
                  $isValid = false;
               }
             if(empty($Username) or strlen($Username) > 15)
               {
                  $UsernameErr = "Username can not be empty or > 15 Character.";
                  $isValid = false;
               }
             if(empty($Password) or strlen($Password) > 15)
               {
                  $PasswordErr = "Password can not be empty or > 15 Character.";
                  $isValid = false;
               }

               if($_POST['Password'] != $_POST['PasswordAgain'])
                  { 
                    $Password_not_match = "Password dose not match";
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


    <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST" name="RegistrationForm" onsubmit="return jsValid();" >



        <fieldset>
           <legend>Basic Information:</legend>

      <table>
       <tbody>

         <tr>
           <td><label for="fname">First Name:<span style="color: red"><?php echo "*"; ?></span></label></td>
           <td><input type="text" id="fname" name="Firstname" value="<?php echo $Firstname ?>">
           <span style="color: red"> <?php echo $FirstnameErr; ?> </span>
           <span id="FirstnameErr" style="color: red;"></span></td>
        </tr>

         <tr>
           <td><label for="lname">Last name:<span style="color: red"><?php echo "*"; ?></span> </label></td>
           <td><input type="text" id="lname" name="Lastname"value="<?php echo $Lastname ?>">
           <span style="color: red"> <?php echo $LastnameErr; ?> </span>
           <span id="LastnameErr" style="color: red;"></span></td>
        </tr>


           <tr>
           <td> Select Gender:<span style="color: red"><?php echo "*"; ?></span></td>
           <td><input type="radio" id="Male" name="Gender" value="Male">
           <label for="Male">Male</label>  
          
           <input type="radio" id="Female" name="Gender" value="Female"> 
           <label for="Female">Female</label> 
         
           <input type="radio" id="Other" name="Gender" value="Other"> 
           <label for="Other">Other</label>
          <span style="color: red"> <?php echo $GenderErr; ?> </span>
         <span id="GenderErr" style="color: red;"></span></td>
           </tr>


         <tr>
           <td><label for="DOB">DOB:<span style="color: red"><?php echo "*"; ?></span></label></td>
           <td><input type="date" id="DOB" name="DOB"value="<?php echo $DOB ?>">
          <span style="color: red"> <?php echo $DOBErr; ?> </span>
          <span id="DOBErr" style="color: red;"></span></td>
        </tr>

         <tr>
           <td>Religion:</td>
           <td>
           <select name="Religion" > 
             <!--  <option value="" name="" ></option>  -->
              <option value="islam" name="Religion" >islam</option> 
              <option value="hindu" name="Religion" >hindu</option> 
              <option value="christian" name="Religion" >christian</option> 
          </select>
          <span style="color: red"> <?php echo $ReligionErr; ?> </span>
          <span id="ReligionErr" style="color: red;"></span></td>
       </tr>

       </tbody>
    </table>

      </fieldset>
      <br><br><br>




      <fieldset>
        <legend>Contact Information:</legend>


        <table>
           <tbody>

              <tr>
                 <td><label for="Presentaddress">presentaddress:</label></td>
                 <td><textarea id="Presentaddress" name="Presentaddress" rows="2" cols="20"></textarea>
                <span style="color: red"> <?php echo $Present_AddressErr; ?> </span>
                <span id="PresentaddressErr" style="color: red;"></span></td>
              </tr>

              <tr>
                <td><label for="Permanentaddress">Permanentaddress:</label></td>
                <td><textarea id="Permanentaddress" name="Permanentaddress" rows="2" cols="20"></textarea>
                <span style="color: red"> <?php echo $Permanent_AddressErr; ?> </span>
                <span id="PermanentaddressErr" style="color: red;"></span></td>
             </tr>


             <tr>
               <td><label for="phone">phone:<span style="color: red"><?php echo "*"; ?></label></span>
               <td><input type="tel" id="phone" name="phone"value="<?php echo $Phone ?>">
               <span style="color: red"> <?php echo $PhoneErr; ?> </span>
               <span id="PhoneErr" style="color: red;"></span></td>
              </tr>

              <tr>
                <td><label for="Email">Email:<span style="color: red"><?php echo "*"; ?></span> </label>
                <td><input type="Email" id="Email" name="Email"value="<?php echo $Email ?>">
                <span style="color: red"> <?php echo $EmailErr; ?> </span>
                <span id="EmailErr" style="color: red;"></span></td>
             </tr>

             <tr>
                <td><label for="Website">Personal Website linked : </label></td>
                <td><input type="url" id="Website" name="Website"value="<?php echo $Website ?>">
                <span style="color: red"> <?php echo $WebsiteErr; ?> </span>
                <span id="WebsiteErr" style="color: red;"></span></td>
             </tr>
          </tbody>
       </table>


    </fieldset>


      <br><br><br>


      <fieldset>
        <legend>Account Information:</legend>

        <table>
         <tbody>

            <tr>
              <td><label for="Username">Username:<span style="color: red"><?php echo "*"; ?></span></label></td>
              <td><input type="text" id="Username" name="Username" placeholder="Username"value="<?php echo $Username ?>">
              <span style="color: red"> <?php echo $UsernameErr; ?> </span>
              <span id="UsernameErr" style="color: red;"></span></td>
           </tr>

           <tr>
             <td><label for="Password">Password:<span style="color: red"><?php echo "*"; ?></span></label></td>
             <td><input type="Password" id="Password" name="Password" placeholder="Enter Password">
              <span style="color: red"><?php echo $Password_not_match; ?></span>
              <span style="color: red"> <?php echo $PasswordErr; ?> </span>
              <span id="PasswordErr" style="color: red;"></span></td>
           </tr>

           <tr>
             <td><label for="PasswordAgain">Password:<span style="color: red"><?php echo "*"; ?></span></label></td>
             <td><input type="Password" id="PasswordAgain" name="PasswordAgain" placeholder="Re-Enter Password"value="<?php echo $bookid ?>">
             <span style="color: red"> <?php echo $PasswordErr; ?> </span></td>
             <span id="PasswordAgainErr" style="color: red;"></span></td>
          </tr>

       </tbody>
    </table>



 </fieldset>

      <br>
      <input type="submit" value="Sign-up">

      <span style="color: red"><?php echo $signupFailed; ?></span>
      <span style="color: green"><?php echo "<br><br><br>click here to <a href = 'login.php'>login</a>" ?></span>


  </form>




  <script>
    
    function jsValid() 
    { 
 
        var fname = document.forms["RegistrationForm"]["fname"].value;
        var lname = document.forms["RegistrationForm"]["lname"].value;
        var gender = document.forms["RegistrationForm"]["Gender"].value;
        var dob = document.forms["RegistrationForm"]["DOB"].value;
        var religion = document.forms["RegistrationForm"]["Religion"].value;
        var preAddress = document.forms["RegistrationForm"]["Presentaddress"].value;
        var perAddress = document.forms["RegistrationForm"]["Permanentaddress"].value;
        var phone = document.forms["RegistrationForm"]["phone"].value;
        var email = document.forms["RegistrationForm"]["Email"].value;
        var website = document.forms["RegistrationForm"]["Website"].value;
        var username = document.forms["RegistrationForm"]["Username"].value;
        var password = document.forms["RegistrationForm"]["Password"].value;
        var passwordAgain = document.forms["RegistrationForm"]["PasswordAgain"].value;
 
  

        if (fname === "" || fname.length > 15) 
        {
            document.getElementById('FirstnameErr').innerHTML = "Firstname can not be empty or > 15 Character.....";
            return false;
        } 
        if (lname === "" || lname.length > 15) 
        {
            document.getElementById('LastnameErr').innerHTML = "Lastname can not be empty or > 15 Character.";
            return false;
        } 
        if (gender === "") 
        {
            document.getElementById('GenderErr').innerHTML = "gender can not be empty..";
            return false;
        } 
        if (dob === "") 
        {
            document.getElementById('DOBErr').innerHTML = "dob can not be empty.";
            return false;
        } 
        if (religion === "" || religion.length > 15) 
        {
            document.getElementById('ReligionErr').innerHTML = "Religion can not be empty or > 15 Character.";
            return false;
        } 
        if (preAddress.length > 100) 
        {
            document.getElementById('Present_AddressErr').innerHTML = "Present Address can not be > 100 Character.";
            return false;
        } 
        if (perAddress.length > 100) 
        {
            document.getElementById('Permanent_AddressErr').innerHTML = "Permanent Address can not be > 100 Character.";
            return false;
        } 
        if (phone === "" || phone.length > 15) 
        {
            document.getElementById('PhoneErr').innerHTML = "Phone can not be empty or > 15 Character.";
            return false;
        } 
        if (email === "" || email.length > 30) 
        {
            document.getElementById('EmailErr').innerHTML = "Email can not be empty or > 30 Character.";
            return false;
        } 
        if (website.length > 50) 
        {
            document.getElementById('WebsiteErr').innerHTML = "website can not be > 50 Character.";
            return false;
        } 
        if (username === "" || username.length > 15) 
        {
            document.getElementById('UsernameErr').innerHTML = "Username can not be empty or > 15 Character.";
            return false;
        } 

        if (password === "" || password.length > 15) 
        {
            document.getElementById('PasswordErr').innerHTML = "password can not be empty or > 15 Character.";
            return false;
        } 
       if (passwordAgain === "" || password.length > 15) 
        {
            document.getElementById('PasswordAgainErr').innerHTML = "password can not be empty or > 15 Character.";
            return false;
        } 
 
    }
 
  </script>

</body>
</html>