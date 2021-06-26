	 
<?php 

// use as database
$j_id = "";
$j_pass = "";
$loginFailed = "";



if(isset($_POST['login'])) // only can enter this page if login button pressed.
{
	// get data from html form	
	$f_id = $_POST['Username'];
	$f_pass = $_POST['Password'];





   	// fetch id password from json file.
	$fetch_data = json_decode(file_get_contents("signup_info.json")); 
	foreach ($fetch_data as $key )
	{
		if($key->Username == $f_id)
		{
			$j_id = $key->Username;
			$j_pass = $key->Password;
		}
	}





	// check input with database.
	if($f_id == $j_id and $f_pass == $j_pass)
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
	else
	{
		// if id pass not match with database back to login page with error message by session.
		$loginFailed = "username or password is Invalid";
		session_start();
		$_SESSION['loginFailed'] = $loginFailed;
		header('location: login.php');
	}
}
else
{
	header('location: login.php');
}
?>

