const token = document.querySelector('meta[name="csrf-token"]').content;
let userId = document.querySelector('meta[name="user"]').content;

let frmAddVehicle = document.querySelector(".frm-add-vehicle");
frmAddVehicle.addEventListener("submit", function (e) {
    e.preventDefault();
    let vehicleModel = document.querySelector(".ipt-vehicle-model");
    let vehiclePlate = document.querySelector(".ipt-vehicle-plate");
    let vehicleReg = document.querySelector(".ipt-vehicle-registration");
    let dLicence = document.querySelector(".ipt-dl");

    let vehicleInfo = {
        _token: token,
        model: vehicleModel.value,
        plate: vehiclePlate.value,
        registration: vehicleReg.value,
        dLicence: dLicence.value,
    };
    fetch("/riders", {
        headers: {
            "Content-Type": "application/json",
        },
        method: "POST",
        body: JSON.stringify(vehicleInfo),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
            alert(res);
        });
    });
});
