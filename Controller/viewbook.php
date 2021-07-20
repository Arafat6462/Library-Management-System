<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View books</title>

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


	<h3><span style="padding: 14px 16px;"> View books</span></h3>
	
	<table style="width:80%">
		<tr>
			<th>Bookname</th>
			<th>Authorname</th> 
			<th>edition</th>
			<th>Numberofcopy</th>
			<th>shelfno</th>
			<th>bookid</th>
		</tr>

		<?php

		// fetch data from json file.
		$fetch_data = json_decode(file_get_contents("../Model/books.json"));
 		foreach ($fetch_data as $arr  )
		{
  			foreach ($arr as $key => $value)
  			{
  				echo  "<td>".$value."</td>";
   				if($key == "bookno")
  					echo "<tr>";
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
