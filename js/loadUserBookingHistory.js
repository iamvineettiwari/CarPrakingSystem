var loadArea = document.getElementById("loadData");
var myLoader = document.getElementById("myLoader");

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}

function loadHistoryData() {
    var par = getUrlParam('page','Empty');
    par = (par == "Empty") ? "1" : par;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../bin/functions/loadUserBookingHistory.php?page='+par);
    xhr.onload = function() {
        if (xhr.status == 200) {
            loadArea.innerHTML = xhr.response;
            myLoader.classList.remove("hide");
        } else {
            loaderBar.classList.add("hide");
            regBtn.classList.remove("hide");
            swal("Something went wrong", "Please try again after sometime.", "error");
        }
    }
    
    xhr.send();
    
}
loadHistoryData();

setInterval(loadHistoryData, 1000);