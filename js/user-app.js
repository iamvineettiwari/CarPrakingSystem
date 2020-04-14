let lastLat = 0;
let lastLong = 0;
let getPlaceData = document.getElementById("getPlaceData");
function getUser() {
    if (navigator.geolocation) {        
        navigator.geolocation.watchPosition(getUserLocation);
    } else {
        swal("Error", "It seems your browser does not supports geolocation !", "error");
    }
}

function getUserLocation(position) {
    if (position.coords.latitude - lastLat > 5 || position.coords.longitude - lastLong > 5) {
        lastLat = position.coords.latitude;
        lastLong = position.coords.longitude;
        loadLocation();
    }
}

function loadLocation() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "https://api.tomtom.com/search/2/reverseGeocode/" + lastLat + "," + lastLong + ".json?key=zfph6ZjSAJgfeKS7V67TAfRyLYRxqvTz");
    xhr.send();
    xhr.onload = function() {
        if (xhr.status == 200) {
            let data = JSON.parse(xhr.response);
            $("#current-location").html(data.addresses[0].address.freeformAddress);
        }
    };
}

getUser();

function rederData() {    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../bin/functions/getPlaces.php?lat="+lastLat+"&long="+lastLong);
    xhr.send();
    xhr.onload = function() {
        getPlaceData.innerHTML = xhr.response;
    }
}
setInterval(rederData, 1000);