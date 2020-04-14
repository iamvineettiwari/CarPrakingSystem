let myLoader = document.getElementById("myLoader");
function deleteAdmin(aid) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, the admin will not be able to work here.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "../bin/functions/deleteAdmin.php?" + aid);
                xhr.send();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if (xhr.response == "deleted") {
                            M.toast({ html: 'Successfully deleted the admin!', classes: 'green white-text' });
                            loadAdminList();
                        } else {
                            M.toast({ html: 'Something went wrong while deleting the admin.', classes: 'red white-text' });
                        }
                    } else {
                        M.toast({ html: 'Can not process your request at this time. Please try again !', classes: 'red white-text' });
                    }
                };
            }
        });
};

function loadAdminList() {
    myLoader.classList.remove("hide");
    let loadArea = document.getElementById("loadAdminList");
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "../bin/functions/loadAdmin.php");

    xhr.onload = function () {
        if (xhr.status == 200) {
            myLoader.classList.add("hide");
            loadArea.innerHTML = xhr.response;
            $("form[name='deleteProfileBtn']").each(function () {
                $(this).submit(function (event) {
                    event.preventDefault();
                    deleteAdmin($(this).serialize());
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
    xhr.open("GET", "../bin/functions/loadAdminProfile.php?" + aid);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status == 200) {
            profLoader.classList.add("hide");
            profArea.innerHTML = xhr.response;
        } else {
            profLoader.classList.add("hide");
            profArea.innerHTML = "<br><br><h5 class='center'>Could not load admin profile.</h5><p class='center'>Please try again. </p>";
        }
    };
}

loadAdminList();