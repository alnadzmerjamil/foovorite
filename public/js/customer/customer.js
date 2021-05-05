let groupOfOrders = document.querySelectorAll(".div-group-order");
let textHead = document.getElementById("order-text");
groupOfOrders.forEach((groupOfOrder) => {
    if (groupOfOrder.textContent.trim() == "") {
        groupOfOrder.style.display = "none";

        textHead.textContent = "You missed to order today, order now!";
    } else {
        textHead.textContent = "ACTIVE ORDERS";
    }
});

let statusIcons = document.querySelectorAll(".fa-exclamation-circle");
let modal = document.querySelector(".div-for-modal");
statusIcons.forEach((icon) => {
    icon.addEventListener("click", function () {
        modal.style.display = "block";
    });
    icon.addEventListener("mouseover", function () {
        let toolTip = document.getElementById("tool-tip-" + icon.id);
        toolTip.style.display = "block";
    });
    icon.addEventListener("mouseout", function () {
        let toolTip = document.getElementById("tool-tip-" + icon.id);
        toolTip.style.display = "none";
    });
});

//cancel modal
let xBtn = document.getElementById("x-btn");
xBtn.addEventListener("click", function () {
    modal.style.display = "none";
});
