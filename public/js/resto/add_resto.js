const token = document.querySelector('meta[name="csrf-token"]').content;
let frmAddResto = document.querySelector(".frm-add-resto");
let restoName = document.querySelector(".ipt-resto-name");
let restoAdd = document.querySelector(".ipt-resto-add");
let saveBtn = frmAddResto.querySelector(".save-btn");

// ADD RESTO
let divForAllResto = document.querySelector(".div-for-display-all-resto");

frmAddResto.addEventListener("submit", (e) => {
    e.preventDefault();

    // Capitalizing resto name
    let restoNameArr = restoName.value.trim().split(" ");
    let restoNAmeCapitalized = new Array();
    restoNameArr.forEach((resto) => {
        let sliced = resto.slice(1).toLowerCase();
        let firstLetter = resto.charAt(0).toUpperCase();
        console.log(firstLetter + sliced);
        restoNAmeCapitalized.push(firstLetter + sliced);
    });
    console.log(restoNameArr);
    console.log(restoNAmeCapitalized.join(" "));

    // Capitalizing resto address
    let restoAddArr = restoAdd.value.trim().split(" ");
    let restoAddCapitalized = new Array();
    restoAddArr.forEach((resto) => {
        let sliced = resto.slice(1).toLowerCase();
        let firstLetter = resto.charAt(0).toUpperCase();
        console.log(firstLetter + sliced);
        restoAddCapitalized.push(firstLetter + sliced);
    });
    console.log(restoAddArr);
    console.log(restoAddCapitalized.join(" "));

    // return;

    fetch("/restaurants", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        body: JSON.stringify({
            _token: token,
            restoName: restoNAmeCapitalized.join(" "),
            restoAddress: restoAddCapitalized.join(" "),
        }),
    }).then((res) => {
        res.text().then((res) => {
            let restoNameToAppend = document.createElement("span");
            restoNameToAppend.classList.add("span-resto");
            restoNameToAppend.textContent = restoNAmeCapitalized.join(" ");

            let restoAddToAppend = document.createElement("span");
            restoAddToAppend.classList.add("sml-resto-add");
            restoAddToAppend.textContent = restoAddCapitalized.join(" ");

            let divPerResto = document.createElement("div");
            divPerResto.classList.add("div-per-resto");
            divPerResto.append(restoNameToAppend, restoAddToAppend);
            divForAllResto.append(divPerResto);

            alert(`Thank you! keep your resto ID "${JSON.parse(res).id}"`);
            console.log(res);
            restoName.value = "";
            restoAdd.value = "";
        });
    });
});

// EDIT OR DELETE RESTO
let spanRestos = document.querySelectorAll(".span-resto");
spanRestos.forEach((resto) => {
    resto.addEventListener("click", () => {
        let user = resto.getAttribute("data-user");
        alert(resto.textContent.trim() + " - " + user);
    });
});
