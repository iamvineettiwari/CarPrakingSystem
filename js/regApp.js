let registerForm = document.getElementById("registration_form");
let loaderBar = document.getElementById("myLoader");
let regBtn = document.getElementById("reg-btn-div");
registerForm.addEventListener("submit", function(event){
    event.preventDefault();
    loaderBar.classList.remove("hide");  
    regBtn.classList.add("hide");  
    let formData = new FormData(registerForm);
    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'bin/functions/register.php');

    xhr.send(formData);
    
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log(xhr.response);
            if (xhr.response == "true") {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Successfully Registered", "Check your mail and verify your account to continue.", "success");
                registerForm.reset();
            } else if (xhr.response == "not true") {
                
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Email in use !", "User already exists with same email.", "error");
            } else {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Something went wrong", "Please try again after sometime.", "error");
            }
        } else {
            loaderBar.classList.add("hide");
            regBtn.classList.remove("hide");
            swal("Something went wrong", "Please try again after sometime.", "error");
        }
    }
});
