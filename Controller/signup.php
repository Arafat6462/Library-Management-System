 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Sign-Up</title>
    <link rel="stylesheet" href="../View/signup.css">
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

             if(empty($Firstname) or strlen($Firstname) > 3)
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
                <input type="url" placeholder="www.arafat.com" id="Website" name="Website" value="<?php echo $Website ?>">
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
                <input type="password" placeholder="Arafat123" id="Password" name="Password" value="<?php echo $Password ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $PasswordErr; ?> </span>
            </div>  

            <div class="form-control">
                <lable>Password check</lable>
                <input type="password" placeholder="Arafat123" id="PasswordAgain" name="PasswordAgain" value="<?php echo $PasswordAgain ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $PasswordAgainErr; ?> </span>
            </div>  


            <button type="submit">Submit</button>
        </form>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->


 



  <script>
    
    function jsValid() 
    { 
        const form = document.getElementById('form'); // full form
        const Firstname = document.getElementById('Firstname'); // full input field
        const Lastname = document.getElementById('Lastname');
        const Gender = document.forms["form"]["Gender"];
        const Dob = document.getElementById('Dob');
        const Religion = document.getElementById('Religion');
        const Presentaddress = document.getElementById('Presentaddress');
        const Permanentaddress = document.getElementById('Permanentaddress');
        const Phone = document.getElementById('Phone');
        const Email = document.getElementById('Email');
        const Website = document.getElementById('Website');
        const Username = document.getElementById('Username');
        const Password = document.getElementById('Password');
        const PasswordAgain = document.getElementById('PasswordAgain');

        console.log(Gender);
        console.log('nooo');
        console.log(Gender[2].checked);
        console.log(Gender[2].parentElement);
        console.log(Gender[2].parentElement.parentElement);



        var flag = true;       
        checkInputs();

 

        function checkInputs() {
            //get the value from inputs.

            const FirstnameValue = Firstname.value.trim(); // full input field
            const LastnameValue = Lastname.value.trim();  
            const GenderValue = Gender.value.trim();   
            const DobValue = Dob.value.trim();   
            const ReligionValue = Religion.value.trim();   
            const PresentaddressValue = Presentaddress.value.trim();   
            const PermanentaddressValue = Permanentaddress.value.trim();   
            const PhoneValue = Phone.value.trim();   
            const EmailValue = Email.value.trim();   
            const WebsiteValue = Website.value.trim();   
            const UsernameValue = Username.value.trim();   
            const PasswordValue = Password.value.trim();   
            const PasswordAgainValue = PasswordAgain.value.trim();   

            console.log(PresentaddressValue);
            console.log(PermanentaddressValue);


            if (FirstnameValue === ''){
                //show error
                // add error class
                setErrorFor(Firstname,'Firstname cannot be blank');
                flag = false;
            }
            else if(FirstnameValue.length > 15){
                setErrorFor(Firstname,'Firstname cannot be > 15 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(Firstname);
            }



            if (LastnameValue === ''){
                setErrorFor(Lastname,'Lastname cannot be blank');
                flag = false;
            }
            else if(LastnameValue.length > 15) {
                setErrorFor(Lastname,'Lastname cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Lastname);


 
            if (Gender[0].checked == false && Gender[1].checked == false && Gender[2].checked == false){
                setErrorFor(Gender[0],'Gender cannot be empty') 
                flag = false;
            }
            else if(GenderValue.length > 10) {
                setErrorFor(Gender,'Gender cannot be > 15 character');
                flag = false;
            }
             else setSuccessFor(Gender[0]);



            if (DobValue === '') {
                setErrorFor(Dob,'Dob cannot be blank');
                flag = false;
            }
            else setSuccessFor(Dob);



            if (ReligionValue === '') {
                setErrorFor(Religion,'Religion cannot be blank');
                flag = false;
            }
            else if(ReligionValue.length > 15) {
                setErrorFor(Religion,'Religion cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Religion);



            if(PresentaddressValue.length > 100) {
                setErrorFor(Presentaddress,'Presentaddress cannot be > 100 character');
                flag = false;
            }
            else setSuccessFor(Presentaddress);



            if(PermanentaddressValue.length > 100) {
                setErrorFor(Permanentaddress,'Permanentaddress cannot be > 100 character');
                flag = false;
            }
            else setSuccessFor(Permanentaddress);



            if (PhoneValue === '') {
                setErrorFor(Phone,'Phone cannot be blank');
                flag = false;
            }
            else if(PhoneValue.length > 15) {
                setErrorFor(Phone,'Phone cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Phone);



            if (EmailValue === '') {
                setErrorFor(Email,'Email cannot be blank');
                flag = false;
            }
            else if(EmailValue.length > 30) {
                setErrorFor(EmailEmail,'Email cannot be > 30 character');
                flag = false;
            }
            else setSuccessFor(Email);



            if (WebsiteValue.length > 50 ) {
                setErrorFor(Website,'Website cannot be >50 character');
                flag = false;
            }
            else setSuccessFor(Website);



            if (UsernameValue === '') {
                setErrorFor(Username,'Username cannot be blank');
                flag = false;
            }
            else if(UsernameValue.length > 15) {
                setErrorFor(Username,'Username cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Username);



            if (PasswordValue === '') {
                setErrorFor(Password,'Password cannot be blank');
                flag = false;
            }
            else if(PasswordValue.length > 15) {
                setErrorFor(Password,'Password cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Password);



            if (PasswordAgainValue === '') {
                setErrorFor(PasswordAgain,'PasswordAgain cannot be blank');
                flag = false;
            }
            else if(PasswordAgainValue.length > 15) {
                setErrorFor(PasswordAgain,'Password cannot be > 15 character');
                flag = false;
            }
            else if(PasswordAgainValue !== PasswordValue) {
                setErrorFor(PasswordAgain,'Password does not match');
                flag = false;
            }
            else setSuccessFor(PasswordAgain);

         
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

</body>
</html>