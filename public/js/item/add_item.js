const token = document.querySelector('meta[name="csrf-token"]').content;
const userId = document.querySelector('meta[name="user"]').content;
console.log(userId);
let frmAddItem = document.querySelector(".frm-add-item");
let itemName = document.querySelector(".ipt-item-name");
let itemCategory = document.querySelector(".select-category");
let itemPrice = document.querySelector(".ipt-item-price");
let itemImg = document.querySelector(".ipt-item-image");
let itemRestoId = document.querySelector(".select-resto");
let addItemBtn = document.querySelector("#add-item-btn");

addItemBtn.addEventListener("click", function () {
    title.textContent = "ADD ITEM";
    divModal.style.display = "block";
    divSaveItem.style.display = "block";
    divForSaveBtn.style.display = "block";
    confirmModal.style.display = "none";
    divForUpdateBtn.style.display = "none";
    return;
});
// ADD ITEM
frmAddItem.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log(itemName.value);
    console.log(itemCategory.value);
    console.log(itemPrice.value);
    // return console.log(itemImg.value);
    console.log(itemRestoId.value);

    // Capitalizing resto name
    // let restoNameArr = restoName.value.trim().split(" ");
    // let restoNAmeCapitalized = new Array();
    // restoNameArr.forEach((resto) => {
    //     let sliced = resto.slice(1).toLowerCase();
    //     let firstLetter = resto.charAt(0).toUpperCase();
    //     console.log(firstLetter + sliced);
    //     restoNAmeCapitalized.push(firstLetter + sliced);
    // });
    // console.log(restoNameArr);
    // console.log(restoNAmeCapitalized.join(" "));

    // Capitalizing resto address
    // let restoAddArr = restoAdd.value.trim().split(" ");
    // let restoAddCapitalized = new Array();
    // restoAddArr.forEach((resto) => {
    //     let sliced = resto.slice(1).toLowerCase();
    //     let firstLetter = resto.charAt(0).toUpperCase();
    //     console.log(firstLetter + sliced);
    //     restoAddCapitalized.push(firstLetter + sliced);
    // });
    // console.log(restoAddArr);
    // console.log(restoAddCapitalized.join(" "));

    fetch("/items", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        body: JSON.stringify({
            _token: token,
            name: itemName.value,
            categoryId: itemCategory.value,
            price: itemPrice.value,
            restoId: itemRestoId.value, //ID pa rin ito kc value ng <option>
            image: itemImg.value,
        }),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
        });
    });
});

//DISPLAY ITEMS
let selectRestodocument = document.querySelector(".select-resto-on-display");
selectRestodocument.addEventListener("change", function () {
    // alert("ji");
    console.log(selectRestodocument.value);
});

//QUERIES FOR RESTOS AND ITEMS
let allRestos = document.querySelector(".all-restos");
allRestos = JSON.parse(allRestos.getAttribute("data-resto"));
// allRestos.forEach((resto) => {
//     console.log(resto.name + resto.id);
// });

// let allItems = document.querySelector(".all-items");
// allItems = JSON.parse(allItems.getAttribute("data-items"));
// console.log(allItems);
// allItems.forEach((item) => {
//     if (item.resto.user_id == userId) {
//         console.log(item.name + "-");
//     }
//     // console.log(item.name);
// });

//MODAL
let divModal = document.querySelector(".div-for-modal");
let divSaveItem = document.querySelector(".div-add-item"); //for add and edit
let confirmModal = document.querySelector(".div-modal"); //for delete
let divForSaveBtn = document.querySelector(".div-save-btn");
let divForUpdateBtn = document.querySelector(".div-update-btn");

let frmDeleteItem = document.querySelector(".frm-delete-item");
let cancelBtn = document.querySelector("#cancel-delete-btn");
let deleteBtn = document.querySelector("#yes-delete-btn");
function closeModal() {
    divModal.style.display = "none";
}

// DELETE ITEM
let deleteItemBtns = document.querySelectorAll(".delete-item-btn");

deleteItemBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
        let item = document.querySelector("#item-" + btn.id);
        divModal.style.display = "block";
        confirmModal.style.display = "block";
        divSaveItem.style.display = "none";
        deleteItem(item, btn.id);
    });
});
cancelBtn.addEventListener("click", closeModal);

function deleteItem(item, itemId) {
    frmDeleteItem.addEventListener("submit", function (e) {
        e.preventDefault();
        alert(itemId);
        // return;
        fetch("/items/" + itemId, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "DELETE",
            body: JSON.stringify({ _token: token, body: itemId }),
        })
            .then((res) => res.text())
            .then((res) => {
                console.log(res);
            });
        item.style.display = "none";
        divModal.style.display = "none";
    });
}

//EDIT ITEM
let editBtns = document.querySelectorAll(".edit-item-btn");
let defaultRestoOption = document.querySelector("#default-resto");
let defaultCategoryOption = document.querySelector("#default-category");
let title = document.querySelector("#str-head");
let closeBtn = document.querySelector("#x-btn");
closeBtn.addEventListener("click", closeModal);

editBtns.forEach((editBtn) => {
    editBtn.addEventListener("click", function () {
        divModal.style.display = "block";
        divSaveItem.style.display = "block";
        confirmModal.style.display = "none";
        divForSaveBtn.style.display = "none";
        title.textContent = "UPDATE ITEM";

        let itemDetails = JSON.parse(this.getAttribute("data-item-details"));
        let itemRestoDetails = JSON.parse(this.getAttribute("data-item-resto"));
        let itemCategoryDetails = JSON.parse(
            this.getAttribute("data-item-category")
        );
        console.log(itemDetails);
        frmUpdate.action = "/items/" + itemDetails.id; //url ng form update
        console.log(frmUpdate.action);
        itemName.value = itemDetails.name;
        itemCategory.value = itemCategoryDetails.id;
        itemPrice.value = itemDetails.price;
        itemImg.value = itemDetails.image;
        defaultRestoOption.value = itemRestoDetails.id;

        defaultCategoryOption.textContent = itemCategoryDetails.name;
        defaultRestoOption.textContent = itemRestoDetails.name;
        console.log(itemImg.value);
        // console.log(itemRestoId.value);
    });
});

let frmUpdate = document.querySelector(".frm-update-item");
frmUpdate.addEventListener("submit", (e) => {
    e.preventDefault();

    console.log(itemImg.value);
    fetch(frmUpdate.action, {
        //nasa line 185
        headers: {
            "Content-Type": "application/json",
        },
        method: "PUT",
        body: JSON.stringify({
            _token: token,
            name: itemName.value,
            categoryId: itemCategory.value,
            price: itemPrice.value,
            restoId: itemRestoId.value, //ID pa rin ito kc value ng <option>
            image: itemImg.value,
        }),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
            // window.location.reload();
        });
    });
});
// const frmTest = document.querySelector(".frm-test");
// frmTest.addEventListener("submit", function (e) {
//     e.preventDefault();
// });
