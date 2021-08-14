  
    function jsValid() 
    { 
        const form = document.getElementById('form'); // full form
        const Firstname = document.getElementById('Firstname'); // full input field
        const Lastname = document.getElementById('Lastname');
        const Gender = document.forms["form"]["Gender"];
        const Dob = document.getElementById('Dob');
        const Religion = document.getElementById('Religion');
        const Presentaddress = document.getElementById('Presentaddress');
        const Permanentaddress = document.getElementById('Permanentaddress');
        const Phone = document.getElementById('Phone');
        const Email = document.getElementById('Email');
        const Website = document.getElementById('Website');
        const Username = document.getElementById('Username');
        

        var flag = true;       
        checkInputs();

 

        function checkInputs() {
            //get the value from inputs.

            const FirstnameValue = Firstname.value.trim(); // full input field
            const LastnameValue = Lastname.value.trim();  
            const GenderValue = Gender.value.trim();   
            const DobValue = Dob.value.trim();   
            const ReligionValue = Religion.value.trim();   
            const PresentaddressValue = Presentaddress.value.trim();   
            const PermanentaddressValue = Permanentaddress.value.trim();   
            const PhoneValue = Phone.value.trim();   
            const EmailValue = Email.value.trim();   
            const WebsiteValue = Website.value.trim();   
            const UsernameValue = Username.value.trim();   
             


            if (FirstnameValue === ''){
                //show error
                // add error class
                setErrorFor(Firstname,'Firstname cannot be blank');
                flag = false;
            }
            else if(FirstnameValue.length > 15){
                setErrorFor(Firstname,'Firstname cannot be > 15 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(Firstname);
            }



            if (LastnameValue === ''){
                setErrorFor(Lastname,'Lastname cannot be blank');
                flag = false;
            }
            else if(LastnameValue.length > 15) {
                setErrorFor(Lastname,'Lastname cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Lastname);


 
            if (Gender[0].checked == false && Gender[1].checked == false && Gender[2].checked == false){
                setErrorFor(Gender[0],'Gender cannot be empty') 
                flag = false;
            }
            else if(GenderValue.length > 10) {
                setErrorFor(Gender,'Gender cannot be > 15 character');
                flag = false;
            }
             else setSuccessFor(Gender[0]);



            if (DobValue === '') {
                setErrorFor(Dob,'Dob cannot be blank');
                flag = false;
            }
            else setSuccessFor(Dob);



            if (ReligionValue === '') {
                setErrorFor(Religion,'Religion cannot be blank');
                flag = false;
            }
            else if(ReligionValue.length > 15) {
                setErrorFor(Religion,'Religion cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Religion);



            if(PresentaddressValue.length > 100) {
                setErrorFor(Presentaddress,'Presentaddress cannot be > 100 character');
                flag = false;
            }
            else setSuccessFor(Presentaddress);



            if(PermanentaddressValue.length > 100) {
                setErrorFor(Permanentaddress,'Permanentaddress cannot be > 100 character');
                flag = false;
            }
            else setSuccessFor(Permanentaddress);



            if (PhoneValue === '') {
                setErrorFor(Phone,'Phone cannot be blank');
                flag = false;
            }
            else if(PhoneValue.length > 15) {
                setErrorFor(Phone,'Phone cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Phone);



            if (EmailValue === '') {
                setErrorFor(Email,'Email cannot be blank');
                flag = false;
            }
            else if(EmailValue.length > 30) {
                setErrorFor(EmailEmail,'Email cannot be > 30 character');
                flag = false;
            }
            else setSuccessFor(Email);



            if (WebsiteValue.length > 50 ) {
                setErrorFor(Website,'Website cannot be >50 character');
                flag = false;
            }
            else setSuccessFor(Website);



            if (UsernameValue === '') {
                setErrorFor(Username,'Username cannot be blank');
                flag = false;
            }
            else if(UsernameValue.length > 15) {
                setErrorFor(Username,'Username cannot be > 15 character');
                flag = false;
            }
            else setSuccessFor(Username);


 

         
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
 
 