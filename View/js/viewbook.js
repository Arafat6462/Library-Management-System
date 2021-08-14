 
 		function getResult(data)
 		{
 			// alert(data.bookid.value);
 			var req = new XMLHttpRequest();	
 			req.open("GET","http://localhost/wt/library/Controller/viewbookaction.php?datavalue="+data.bookid.value,true); // data is a value of key datavalue.
 			req.send();

 			req.onreadystatechange=function()
 			{
 				if(req.readyState == 4 && req.status==200)
 				{
 					// alert(req.responseText);
 					document.getElementById('result').innerHTML = req.responseText;
 					// document.getElementById('result').innerHTML = JSON.parse(this.responseText);
 					// console.log(JSON.parse(this.responseText));
 					console.log(req.responseText);
 				}

 			}
 		}



 		function deleteFunction(id)
 		{
 			console.log("delete button");
 			console.log(id);
 			 

 			var req = new XMLHttpRequest();	
 			req.open("GET","http://localhost/wt/library/Controller/viewbookactiondelete.php?id="+id,true); // data is a value of key datavalue.
 			req.send();

 			req.onreadystatechange=function()
 			{
 				if(req.readyState == 4 && req.status==200)
 				{
 					// alert(req.responseText);
 					document.getElementById('update').innerHTML = req.responseText;
 					// document.getElementById('result').innerHTML = JSON.parse(this.responseText);
 					// console.log(JSON.parse(this.responseText));
 					console.log(req.responseText);
 				}

 			}
 		}
 
