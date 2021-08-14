    
    function jsValid() 
    { 
        const form = document.getElementById('form'); // full form
        const bookname = document.getElementById('bookname');
        const authorname = document.getElementById('authorname');
        const edition = document.getElementById('edition');
        const numberofcopy = document.getElementById('numberofcopy');
        const shelfno = document.getElementById('shelfno');
        const bookno = document.getElementById('bookno');

        console.log(bookno);

         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            //get the value from inputs.

            const  booknameValue = bookname.value.trim();   
            const  authornameValue = authorname.value.trim();   
            const  editionValue = edition.value.trim();   
            const  numberofcopyValue = numberofcopy.value.trim();   
            const  shelfnoValue = shelfno.value.trim();   
            const  booknoValue = bookno.value.trim();   

            

            if (booknameValue === ''){
                //show error
                // add error class
                setErrorFor(bookname,'Book name cannot be blank');
                flag = false;
            }
            else if(booknameValue.length > 100){
                setErrorFor(bookname,'Book name cannot be > 100 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(bookname);
            }



            if (authornameValue === ''){
                setErrorFor(authorname,'Author name cannot be blank');
                flag = false;
            }
            else if(authornameValue.length > 50) {
                setErrorFor(authorname,'Author name cannot be > 50 character');
                flag = false;
            }
            else setSuccessFor(authorname);



            if (editionValue === ''){
                setErrorFor(edition,'Edition cannot be blank');
                flag = false;
            }
            else if(editionValue.length > 10) {
                setErrorFor(edition,'Edition cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(edition);

         

            if (numberofcopyValue === '') {
                setErrorFor(numberofcopy,'Number of copy cannot be blank');
                flag = false;
            }
            else if(numberofcopyValue.length > 10) {
                setErrorFor(numberofcopy,'Number of copy cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(numberofcopy);

 



            if (shelfnoValue === '') {
                setErrorFor(shelfno,'Shelf no cannot be blank');
                flag = false;
            }
            else if(shelfnoValue.length > 10) {
                setErrorFor(shelfno,'Shelf no cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(shelfno);



            if (booknoValue === '') {
                setErrorFor(bookno,'Book Id cannot be blank');
                flag = false;
            }
            else if(booknoValue.length > 10) {
                setErrorFor(bookno,'Book Id cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(bookno);

 
         
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
  
    
    function jsIdValid() 
    { 
        var searchid = document.forms["SearchBook"]["searchid"].value;
        
        if (searchid === "") 
        {
            document.getElementById('searchidErr').innerHTML = "searchid can not be empty.";
            return false;
        }
        if (searchid.length > 10) 
        {
            document.getElementById('searchidErr').innerHTML = "searchid can not be > 10 Character.";
            return false;
        } 
    }
 
 