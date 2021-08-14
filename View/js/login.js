 
    function jsValid() 
   	 { 
 
        const Username = document.getElementById('Username');
        const Password = document.getElementById('Password');

        var flag = true;       
        checkInputs();

        function checkInputs() 
        {
            //get the value from inputs.

            const UsernameValue = Username.value.trim();   
            const PasswordValue = Password.value.trim();   
 
 
            if (UsernameValue === '') {
                setErrorFor(Username,'Username cannot be blank');
                flag = false;
            }
            else if(UsernameValue.length > 15) {
                setErrorFor(Username,'Username cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Username);



            if (PasswordValue === '') {
                setErrorFor(Password,'Password cannot be blank');
                flag = false;
            }
            else if(PasswordValue.length > 15) {
                setErrorFor(Password,'Password cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Password);

         
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

 