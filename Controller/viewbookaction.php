 
		<tbody>
			<?php
			include '../Model/dbbook.php';
			if(empty($_GET['datavalue']))
			{
				   $bookList = getAllBooks();
 				    
			}
		 	
			else 
			{
				   $bookList = getBookId($_GET['datavalue']);
 
				    
 			}
		 		foreach ($bookList as $arr  )
				{
		  			foreach ($arr as $key => $value)
		  			{
		  				echo  "<td>".$value."</td>";
		   				if($key == "bookid")
		   				{
		   					$id = $arr["bookid"];
		  					echo "<td><a onclick=\"deleteFunction($id)\" href = '#'>Delete</a></td><tr>"; //get id

		   				}
					}
		 		}
			?>
		</tbody>
 


 

