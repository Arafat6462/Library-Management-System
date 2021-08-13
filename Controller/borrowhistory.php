<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow history</title>
	<link rel="stylesheet" href="../View/borrowhistory.css?v <?php echo time(); ?>">
</head>
<body>

	<?php
 	$page = 'borrowhistory';
	include('../View/header.php');
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
 


<?php include('../View/footer.html');?>
</body>
</html>
