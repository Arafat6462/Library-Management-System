<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
</head>
<body>

	<style>

	body{
		background-color: #F4F9F9;
		/*background: linear-gradient(to right top,#65dfc9,#6cdbed);*/
 	}
	 
	.topnav a {
		text-decoration: none;
   		padding: 18px;
		color: black;
	}

	.topnav a:hover {
		background-color: #ddd;
		color: black;
	}
	@media screen and (max-width: 600px){
 			.topnav{
 				flex-direction: column;
 			}
 		}

.topnav{
	background: #cacaca;
	padding: 10px;
	margin: 10px;

	display: flex;
	flex-direction: row;
	justify-content:  ;
	align-items:flex-start;
	border-radius: 8px;
}
.active{
	background-color: #23A96D;
	border-radius: 5px;
}




	 
</style>
 
	<div class="topnav">
 		<a class="<?php if($page == 'welcome'){echo 'active';} ?>" href="../Controller/welcome.php">Home</a>  
		<a class="<?php if($page == 'addbook'){echo 'active';} ?>" href="../Controller/addbook.php">Add new books</a> 
		<a class="<?php if($page == 'viewbook'){echo 'active';} ?>" href="../Controller/viewbook.php">View all books</a>  
		<a class="<?php if($page == 'updatebook'){echo 'active';} ?>" href="../Controller/updatebook.php">Update book info</a>    
		<a class="<?php if($page == 'borrowbook'){echo 'active';} ?>" href="../Controller/borrowbook.php">Borrow book</a>  
		<a class="<?php if($page == 'returnbook'){echo 'active';} ?>" href="../Controller/returnbook.php ">Return book</a>  
		<a class="<?php if($page == 'borrowhistory'){echo 'active';} ?>" href=" ../Controller/borrowhistory.php ">Borrows history</a>  
	 
 		<a href="../Controller/logout.php">Logout </a> 
		<a class="<?php if($page == 'changepassword'){echo 'active';} ?>" href="../Controller/changePassword.php">Change password </a> 
		
 </div>

 	 <hr>


</body>
</html>