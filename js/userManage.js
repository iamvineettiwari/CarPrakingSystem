let myLoader = document.getElementById("myLoader");
function deleteUser(aid) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, the user will not be use this portal.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "../bin/functions/deleteUser.php?" + aid);
                xhr.send();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if (xhr.response == "deleted") {
                            M.toast({ html: 'Successfully deleted the user!', classes: 'green white-text' });
                            loadUserList();
                        } else {
                            M.toast({ html: 'Something went wrong while deleting the user.', classes: 'red white-text' });
                        }
                    } else {
                        M.toast({ html: 'Can not process your request at this time. Please try again !', classes: 'red white-text' });
                    }
                };
            }
        });
}

function loadUserList() {
    myLoader.classList.remove("hide");
    let loadArea = document.getElementById("loadUserList");
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "../bin/functions/loadUser.php");

    xhr.onload = function () {
        if (xhr.status == 200) {
            myLoader.classList.add("hide");
            loadArea.innerHTML = xhr.response;
            $("form[name='deleteProfileBtn']").each(function () {
                $(this).submit(function (event) {
                    event.preventDefault();
                    deleteUser($(this).serialize());
                });
            });
            $("form[name='viewProfile']").each(function () {
                $(this).submit(function (event) {
                    event.preventDefault();
                    showProfile($(this).serialize());
                });
            });
        } else {
            swal("Error !", "Something went wrong while loading admin list.", "error");
        }
    };

    xhr.send();
}

function showProfile(aid) {
    $(".modal").modal('open');
    let profLoader = document.getElementById("myProfileLoader");
    let profArea = document.getElementById("profileArea");
    profLoader.classList.remove("hide");
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../bin/functions/loadUserProfile.php?" + aid);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status == 200) {
            profLoader.classList.add("hide");
            profArea.innerHTML = xhr.response;
        } else {
            profLoader.classList.add("hide");
            profArea.innerHTML = "<br><br><h5 class='center'>Could not load user profile.</h5><p class='center'>Please try again. </p>";
        }
    };
}

loadUserList();