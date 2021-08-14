 
     function jsValid() 
     { 
        const form = document.getElementById('form'); // full form
        const studentid = document.getElementById('studentid');
          
 
         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            const  studentidValue = studentid.value.trim();   
            const  bookidValue = bookid.value.trim();   
 
            if (studentidValue === ''){
                 setErrorFor(studentid,'Student id cannot be blank');
                flag = false;
            }
             else{
                 setSuccessFor(studentid);
            }
  
         }

         function setErrorFor(input, message)
         {
            const formControl = input.parentElement; // .form-control
            const small = formControl.querySelector('small');

            small.innerText = message;

            formControl.className = 'form-control error';
         } 

         function setSuccessFor(input)
         {
            const formControl = input.parentElement; // .form-control
         
             formControl.className = 'form-control success';
         }

         return flag;
         
    }
 
 