 
     function jsValid() 
     { 
        const form = document.getElementById('form'); // full form
        const bookid = document.getElementById('bookid');
        const studentid = document.getElementById('studentid');
         
 
         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            //get the value from inputs.

            const  bookidValue = bookid.value.trim();   
            const  studentidValue = studentid.value.trim();   
            

            if (bookidValue === ''){
                //show error
                // add error class
                setErrorFor(bookid,'Book id cannot be blank');
                flag = false;
            }
            else if(bookidValue.length > 10){
                setErrorFor(bookid,'Book id cannot be > 10 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(bookid);
            }



            if (studentidValue === ''){
                setErrorFor(studentid,'Student id cannot be blank');
                flag = false;
            }
            else if(studentidValue.length > 10) {
                setErrorFor(studentid,'Student id cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(studentid);
         
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
 


