$("#admin_add_form").submit(function(event) {
    event.preventDefault();

    let add = true;
    
    if (document.getElementById('profile').files.length != 0) {
        let fileSize = document.getElementById("profile").files[0].size /1024/1024;
        if (fileSize <= 3) { 
            add = true;
        } else {
            add = false;
        }
    }
    if (add) {
    
        let adminData = new FormData(document.getElementById("admin_add_form"));
        let loaderBar = document.getElementById("myLoader");
        let regBtn = document.getElementById("reg-btn-div");
        
        loaderBar.classList.remove("hide");  
        regBtn.classList.add("hide");
    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../bin/functions/addAdmin.php');

    xhr.send(adminData);
    
    xhr.onload = function() {
        if (xhr.status == 200) { 
            if (xhr.response == "true") {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Successfully Registered", "Admin Added.", "success");
                document.getElementById("admin_add_form").reset();
            } else if (xhr.response == "duplicate username") {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Username in use !", "User already exists with same username.", "error");
            } else if (xhr.response == "duplicate email") {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("Email in use !", "User already exists with same email.", "error");
            }  else if (xhr.response == "file size exceed") {
                loaderBar.classList.add("hide");
                regBtn.classList.remove("hide");
                swal("File size exceed", "File must be below 3 mb.", "error");
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

    } else {
        swal("Photo Size Exceeded !", "Choose profile photo below 3 mb", "error");
    }
    
});