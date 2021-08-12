<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log-in</title>
	<link rel="stylesheet" href="../View/css/login.css?v <?php echo time(); ?>">
</head>
<body>
 	
	<?php

	include('../Model/dblogin.php');
	// sign up message with session
	session_start();
	$signupStatus = $_SESSION['signupStatus'];


	$c_id = $c_pass = "";

	// try to auto login from cookies id, pass if have.
	if(isset($_COOKIE['c_id']))
	{
		$c_id = $_COOKIE['c_id'];
 
		// fetch password from Database.
		$fetch_data = getPassword($c_id);
		for ( $i = 0; $i < count($fetch_data); $i++)
		{
			if($fetch_data[$i]["Username"] === $c_id)
			{
				$c_pass = $fetch_data[$i]["Password"];
  			}

		}

	}	 
 
	session_destroy(); // destroy for delete session message.

	// use as database
	$d_id = "";
	$d_pass = "";
	$loginFailed = "";
	$isValid = true;
	$f_id = $f_pass = "";
	$f_idErr = $f_passErr = "";



if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	// get data from html form	
	$f_id = $_POST['Username'];
	$f_pass = $_POST['Password'];

	if(empty($f_id))
       {
          $f_idErr = "username can not be empty";
          $isValid = false;
       }
	if(empty($f_pass))
       {
          $f_passErr = "password can not be empty";
          $isValid = false;
       }

       $f_id = basic_validation($f_id);
       $f_pass = basic_validation($f_pass);

       if($isValid)
       {

        	$res = login($f_id, $f_pass); 	 
 			if($res)
			{
				// if correct and remember store in cookies
				if(isset($_POST['remember']))
				{
					setcookie('c_id', $f_id, time()+60*60);
		 			
				}

				// log-in to welcome with id,pass
				session_start();
				$_SESSION['s_id'] = $f_id;
				$_SESSION['s_pass'] = $f_pass;
				header("location:welcome.php"); 

			}
			else $loginFailed = "username or password is Invalid";
			

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
            <h2> Log-In</h2>
        </div>

        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST" onsubmit="return jsValid();">
             
            <div class="form-control">
                <lable>Username</lable>
                <input type="text" placeholder="Arafat6462" id="Username" name="Username" value="<?php echo $c_id ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $f_idErr; ?> </span>
            </div>  

             <div class="form-control">
                <lable>Password</lable>
                <input type="password" placeholder="*********" id="Password" name="Password" value="<?php echo $c_pass ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $f_passErr; ?> </span>
            </div>  

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Remember Me</label>
            </div>  
 

            <button type="submit" name="login">Log In</button>

            <span style="color: red"><?php echo $loginFailed; ?></span>
			<span style="color: green"><?php echo "<br><br><br>click here to <a href = 'signup.php'>Sign-up</a>" ?></span>


        </form>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->





  <script>

    function jsValid() 
   	 { 
 
        const Username = document.getElementById('Username');
        const Password = document.getElementById('Password');

        var flag = true;       
        checkInputs();

        function checkInputs() 
        {
            //get the value from inputs.

            const UsernameValue = Username.value.trim();   
            const PasswordValue = Password.value.trim();   
 
 
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