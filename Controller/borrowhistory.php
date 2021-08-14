<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow history</title>
	<link rel="stylesheet" href="../View/css/borrowhistory.css?v <?php echo time(); ?>">
</head>
<body>

	<?php

	/// redirect login for no session
	session_start();
	if(!isset($_SESSION['s_id']))
		header("location:login.php");

 	$page = 'borrowhistory';
	include('../View/css/header.php');
	include '../Model/dbborrowbook.php';
	$bookList = getBorrowHistory();
	?>


 	
	<div class="table">
	<table>
		<thead>
			<tr>
				<th>studentName</th>
				<th>student ID</th> 
				<th>Currenr Borrow</th>
				<th>borrow Book Id</th>
				<th>Total borrowed </th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			<?php
		 		foreach ($bookList as $arr  )
				{
		  			foreach ($arr as $key => $value)
		  			{
		  				echo  "<td>".$value."</td>";
		   				if($key == "allhistory")
		   				{
		   					if($arr["currentBorrow"] == 0) 
		   					{
 		   						?>
 		   						<td><div class="status-no">No Borrow </div></td>
 		   						<?php

		   					}
		   					else
		   					{
		   						 ?>
  		   						<td><div class="status-yes">Borrowed</div></td>
 		   						<?php
		   					}
		  					echo "<tr>"; 
		   				}
					}
		 		}
			?>
		</tbody>
	</table>
	</div>
 


<?php include('../View/css/footer.html');?>
</body>
</html>
