<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow history</title>

	<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
		text-align: center;
		table-layout: auto;
		margin-left: auto;
    	margin-right: auto;
	}
</style>
</head>
<body>

	<?php
		// header file.
		include('../View/header.html');
		?>


	<h3><span style="padding: 14px 16px;"> Borroyw History</span></h3>
	
	<table style="width:80%">
		<tr>
			<th>studentName</th>
			<th>student ID</th> 
			<th>Currenr Borrow</th>
			<th>borrow Book Id</th>
			<th>Total borrowed </th>
  		</tr>

		<?php
		include '../Model/dbborrowbook.php';
		$bookList = getBorrowHistory();
 		foreach ($bookList as $arr  )
		{
  			foreach ($arr as $key => $value)
  			{
  				echo  "<td>".$value."</td>";
   				if($key == "allhistory")
   				{
  					echo "<tr>"; 
   				}
			}
 		}
		?>
		 

	</table>



<?php 
		// header file.
		include('../View/footer.html');
?>
</body>
</html>
