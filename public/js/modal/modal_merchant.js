//MODAL HERE FOR MERCHANT
const token = document.querySelector('meta[name="csrf-token"]').content;
let userId = document.querySelector('meta[name="user"]').content;
let modalContainer = document.querySelector(".div-for-modal");
let enterBtn = document.querySelector("#enter-btn");
let frmEnterFromModal = document.querySelector(".frm-enter-from-modal");
frmEnterFromModal.addEventListener("submit", function (e) {
    // e.preventDefault();
    let inputHiddenForRestoId = document.querySelector("#ipt-resto-id");
    let restos = JSON.parse(enterBtn.getAttribute("data-store-id"));
    let enteredId = document.querySelector(".ipt-store-id");
    let merchant = restos.filter((resto) => {
        return resto.user_id == userId && resto.id == enteredId.value;
    });
    if (merchant.length !== 0) {
        console.log(enteredId.value);
        inputHiddenForRestoId.value = enteredId.value;
        frmEnterFromModal.action = "/authentication";
    } else {
        alert("You entered an invalid resto ID!");
        return e.preventDefault();
        frmEnterFromModal.action = "/";
        frmEnterFromModal.method = "GET";
    }
});
