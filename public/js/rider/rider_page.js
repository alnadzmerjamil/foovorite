let origin = document.getElementById("from");
let destination = document.getElementById("to");
let mapContainer = document.querySelector(".div-map");
let divCustomerOrder = document.querySelector(".div-customer-order");
//use to center the map on your current location
let myLatLng = {
    lat: 14.529407,
    lng: 121.071014,
};

//map properties
let mapOptions = {
    center: myLatLng,
    zoom: 7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
};

//create map
let map = new google.maps.Map(
    document.getElementById("div-google-map"),
    mapOptions
);

//convert lat lng to address
const geocoder = new google.maps.Geocoder();
let myCurrentLocation;
function geocodeLatLng() {
    geocoder.geocode({ location: myLatLng }, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                myCurrentLocation = results[0].formatted_address;
                console.log(myCurrentLocation);
                //your current location
            } else {
                window.alert("No results found");
            }
        } else {
            return alert("Geocoder failed due to: " + status);
        }
    });
}

//get the current location
function getLocation() {
    if ("geolocation" in navigator) {
        console.log("Geolacation Available");
        navigator.geolocation.getCurrentPosition((position) => {
            console.log(position);
            myLatLng.lat = position.coords.latitude;
            myLatLng.lng = position.coords.longitude;
        });
        geocodeLatLng(); //function call to get the current location
    } else {
        alert("Google Map not Responding!");
    }
}

//instance of direction service so that you can use route method and get a result for request
let directionsService = new google.maps.DirectionsService();

//instance of direction renderer, used to display the route
let directionsDisplay = new google.maps.DirectionsRenderer();

//bind the direction renderer to the map
directionsDisplay.setMap(map);

//OWN FUNCTION
function calcRoute() {
    // return alert('calc');
    let request = {
        origin: origin.value,
        destination: destination.value,
        travelMode: google.maps.TravelMode.DRIVING, // WALKING BICYCLING TRANSIT
        unitSystem: google.maps.UnitSystem.METRIC,
    };

    //PASS THE REQUEST TO ROUTE METHOD
    directionsService.route(request, (result, status) => {
        let output = document.querySelector(".div-result");
        let from = document.querySelector(".from");
        let to = document.querySelector(".to");
        let distance = document.querySelector(".distance");
        // return console.log(status);
        // console.log(google.maps.DirectionsStatus.OK);
        if (status == google.maps.DirectionsStatus.OK) {
            //get distance and time
            console.log("dito pumasok");
            from.textContent =
                "From : " + document.getElementById("from").value;
            to.textContent = " To : " + document.getElementById("to").value;
            distance.textContent =
                " Driving Distance : " +
                result.routes[0].legs[0].distance.text +
                " Duration " +
                result.routes[0].legs[0].duration.text;

            //DISPLAY ROUTE
            directionsDisplay.setDirections(result);
        } else {
            //DELETE ROUTE FROM MAP
            console.log("dito pumasok sa delete");
            directionsDisplay.setDirections({ routes: [] });

            //CENTER THE MAP
            map.setCenter(myLatLng);

            //SHOW ERROR MESSAGE
            from.textContent = "Could not retrieve destination!";
        }
    });
}

//CREATE AUTO COMPLETE FOR INPUT
let options = {
    types: ["(cities)"],
};
let input1 = origin;
const autocomplete1 = new google.maps.places.Autocomplete(input1, options);
let input2 = destination;
const autocomplete2 = new google.maps.places.Autocomplete(input2, options);

// compass/direction
let selectDirection = document.querySelector(".select-direction");
selectDirection.style.display = "none";
let compass = document.querySelector(".fa-compass");
compass.addEventListener("click", function () {
    if (destination.value == "" && origin.value == "") {
        selectDirection.style.display = "inline-block";
    } else if (destination.value == "") {
        alert("Eter destination address");
    } else if (origin.value == "") {
        alert("Enter your starting point");
    } else {
        selectDirection.style.display = "inline-block";
        calcRoute(); //to calculate the route
    }

    mapContainer.style.display = "flex";
    divCustomerOrder.style.display = "none";

    //call the get location function here
    getLocation();
});

let storeDirection = document.querySelector(".span-store");
storeDirection.addEventListener("click", function () {
    let storeAdd = document.querySelector(".resto-add");
    origin.value = myCurrentLocation;
    destination.value = storeAdd.textContent;
    selectDirection.style.display = "none";
    calcRoute();
});
let cxDirection = document.querySelector(".span-cx");
cxDirection.addEventListener("click", function () {
    let cxAddress = document.querySelector(".cx-add");
    origin.value = myCurrentLocation;
    destination.value = cxAddress.textContent;
    selectDirection.style.display = "none";
    calcRoute();
});
//close the map
let closeMapBtn = document.querySelector(".x-btn");
closeMapBtn.addEventListener("click", function () {
    mapContainer.style.display = "none";
    selectDirection.style.display = "none";
    // destination.value = "";
    // origin.value = "";
    divCustomerOrder.style.display = "block";
});

let pickUpCheckBox = document.querySelector(".pick-up");
let deliveredCheckBox = document.querySelector(".delivered");
pickUpCheckBox.addEventListener("click", function () {
    pickUpCheckBox.checked = true;
    pickUpCheckBox.disabled = true;
    deliveredCheckBox.disabled = false;
});
// deliveredCheckBox.addEventListener("click", function () {
//     if (!pickUpCheckBox.checked) {
//         deliveredCheckBox.disabled = "true";
//     } else {
//         deliveredCheckBox.disabled = "false";
//     }
// });

//will update every 10 seconds

//will see if rider has delivery
// function hasDelivery() {
//     let flag = document.querySelector(".happy-delivery");
//     flag1 = flag.getAttribute("data-flag");
//     if (!flag1) {
//         flag.textContent = "Keep Safe while waiting your delivery !";
//         compass.style.display = "none";
//         divCustomerOrder.style.display = "none";
//     }
// }
// hasDelivery();
