let loginForm = document.getElementById("login_form");
let loader = document.getElementById("myLoader");
let loginBtn = document.getElementById("log-btn-div");
let userHelp = document.getElementById("username-helper");
let passHelp = document.getElementById("password-helper");
loginForm.addEventListener("submit", function(event){
    event.preventDefault();
    loader.classList.remove("hide");
    loginBtn.classList.add("hide");
    
    let formData = new FormData(loginForm);
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "bin/functions/admLogin.php");

    xhr.send(formData);

    xhr.onload = function() {
        if (xhr.status == 200) {
            if (xhr.response == "true") {
                window.location.href = "admin/";
            } else if (xhr.response == "username") {
                loader.classList.add("hide");
                loginBtn.classList.remove("hide");
                userHelp.innerHTML = "Username is incorrect";
                userHelp.classList.add("red-text");
            } else if (xhr.response == "password") {
                loader.classList.add("hide");
                loginBtn.classList.remove("hide");
                passHelp.innerHTML = "Password is incorrect";
                passHelp.classList.add("red-text");
            } else {
                loader.classList.add("hide");
                loginBtn.classList.remove("hide");
                swal("Access Denied !", "It seems that you are not a admin.", "error");
            }
        } else {
            loader.classList.add("hide");
            loginBtn.classList.remove("hide");
            swal("Something went wrong !", "Please try again !", "error");
        }
    }

});