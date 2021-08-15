<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>welcome</title>
	<link rel="stylesheet" href="../View/css/welcome.css">
</head>
<body>
 
	<?php
	/// redirect login for no session
	session_start();
	if(!isset($_SESSION['s_id']))
		header("location:../");

	// header file.
	 $page = 'welcome';
	 include('../View/html/header.php');
 	 include('../Model/dbwelcome.php');
 


			// fetch profile data
            $profile_id = $_SESSION['s_id'];
  
            $profile_data = getProfileData($profile_id);
            for ( $i = 0; $i < count($profile_data); $i++)
            { 
                    if($profile_data[$i]["Username"] == $profile_id)
                    {
                        $Firstname = $profile_data[$i]['Firstname'];
                        $Lastname = $profile_data[$i]['Lastname'];
                        $Gender = $profile_data[$i]['Gender'];
                        $Email = $profile_data[$i]['Email'];
                        $Username = $profile_data[$i]['Username']; 
                    }
            }

            $totalbook = count(getAllBooks()); 
            $totalstudentList = getAllStudent(); 
            $totalstudent = count($totalstudentList); 
            $totalborrow = 0;

            foreach ($totalstudentList as $arr  )
				{
		  			foreach ($arr as $key => $value)
		  			{
 		   				if($key == "allhistory")
  		   					$totalborrow +=$arr["allhistory"];
  					}
		 		}
 	?>
	 

	<div class="body">
	 <div class="container">
	 	<div class="card">
	 		<div class="box">
	 			<div class="content">
	 				<h2>Profile</h2>
 	 				<a href="#">Name: <?php echo $Firstname." ".$Lastname ?></a>
	 				<a href="#">User ID: <?php echo $Username ?></a>
	 				<a href="#">Gender : <?php echo $Gender ?></a>
	 				<a href="#">Type : Employee</a>
	 				<a href="#">Email : <?php echo $Email ?></a>
	 			</div>
	 		</div>
	 	</div>
	 	<div class="card">
	 		<div class="box">
	 			<div class="content">
	 				<h2>Books</h2>
 	 				<a href="#">You can explore <?php echo $totalbook-1?>+ books</a>
 	 			</div>
	 		</div>
	 	</div>
	 	<div class="card">
	 		<div class="box">
	 			<div class="content">
	 				<h2>Users</h2>
 	 				<a href="#">More than <?php echo $totalstudent-1?>+ users</a>
 	 				<a href="#">More than <?php echo $totalborrow-1 ?>+ borrow</a>
 	 			</div>
	 		</div>
	 	</div>
	 </div>
	 </div>
	
 
 


 	<?php
 	// footer file.
	include('../View/html/footer.html');
	?>
	

	
</body>
</html>