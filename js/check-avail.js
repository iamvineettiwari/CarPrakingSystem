let container = document.getElementById("app");

$("#checkAvail").submit(function (event) {
    event.preventDefault();
    $("#myLoader").removeClass("hide");
    let request = $.ajax({
        url: "../bin/functions/checkAvail.php",
        type: "POST",
        data: $("#checkAvail").serialize(),
        dataType: "html",
    });

    request.done((data) => {
        $("#myLoader").addClass("hide");
        container.innerHTML = data;
    });
    request.fail((data) => {
        $("#myLoader").addClass("hide");
        swal("Error", "Something went wrong !", "error");
    });
});

function goBack() {
    container.innerHTML = "";
    $("#befApp").removeClass("hide");
}