let token = document.querySelector('meta[name="csrf-token"]').content;
// let userId = document.querySelector('meta[name="user"]').content;

//searching
let allItems = document.getElementById("mother").getAttribute("data-all-items");
if (allItems) {
    allItems = JSON.parse(allItems);
}
let itemsAlreadyDisplayed = [];
let searchBox = document.getElementById("input-search");
searchBox.addEventListener("click", function () {
    //magttawag ng function
    detectSearch();
});

let suggestedContainer = document.querySelector(
    ".div-search-suggest-container"
);
let frmSuggestedContainer = document.getElementById("frm-search-suggest");
function detectSearch() {
    //naka display na

    let flag;
    setInterval(function () {
        let alreadyDisplayedSuggestions = document.querySelectorAll(
            ".suggest-btn"
        );
        if (searchBox.value !== "") {
            suggestedContainer.style.display = "block";
            if (flag == searchBox.value) {
                return;
            }
            let keyWord =
                searchBox.value[0].toUpperCase() + searchBox.value.slice(1);
            flag = searchBox.value;
            let suggested = allItems.filter((item) =>
                item.name.startsWith(keyWord)
            );
            //suggested is item na result sa search
            if (suggested.length !== 0) {
                console.log("meron suggested");
                console.log(alreadyDisplayedSuggestions.length);
                suggested.forEach((item) => {
                    if (!itemsAlreadyDisplayed.includes(item.name)) {
                        itemsAlreadyDisplayed.push(item.name);
                        console.log("meron na display");
                        let itemSuggested = document.createElement("button");
                        itemSuggested.classList.add("suggest-btn");
                        itemSuggested.setAttribute(
                            "category-id",
                            item.category_id
                        );
                        itemSuggested.textContent = item.name;
                        frmSuggestedContainer.prepend(itemSuggested);
                        let textSuggestion = document.querySelector(
                            ".p-suggestion-text"
                        );
                        textSuggestion.textContent = "Search Suggestions";
                    }
                    return;
                });

                getAllSuggestedItems();
                return;
            } else if (!frmSuggestedContainer.firstChild) {
                let textSuggestion = document.querySelector(
                    ".p-suggestion-text"
                );
                textSuggestion.textContent = "Item not found";
            }
            return;
        } else {
            suggestedContainer.style.display = "none";
            itemsAlreadyDisplayed = [];
            while (frmSuggestedContainer.firstChild) {
                frmSuggestedContainer.removeChild(
                    frmSuggestedContainer.firstChild
                );
            }
            return;
        }
    }, 1000);
}
var totn_string = "TechOnTheNet";

console.log(totn_string.startsWith("T"));
console.log(totn_string.startsWith("TECH"));

// click the suggested items
function getAllSuggestedItems() {
    let allSuggestedItems = document.querySelectorAll(".suggest-btn");
    allSuggestedItems.forEach((btn) => {
        btn.addEventListener("click", function () {
            let inputCategoryId = document.getElementById("category-id");
            inputCategoryId.value = btn.getAttribute("category-id");
        });
    });
}

//order and save to SESSION (CustomerOrderController)
function fetchToSession(data) {
    fetch("/customers/order", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        body: JSON.stringify(data),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
            if (res == "Order has removed from Session") {
                window.location.reload();
            }
        });
    });
}
let displayContainer = document.querySelector(".div-for-display-items");
let orderContainer = document.querySelector(".div-for-order-container");
let frmOrders = document.querySelectorAll(".frm-order");
frmOrders.forEach((frmOrder) => {
    frmOrder.addEventListener("submit", (e) => {
        e.preventDefault();
        let item = JSON.parse(frmOrder.getAttribute("data-item"));
        let resto = JSON.parse(frmOrder.getAttribute("data-resto"));
        let perOrder = {
            _token: token,
            resto_id: resto.id,
            resto_name: resto.name,
            item_id: item.id,
            item_name: item.name,
            item_price: item.price,
            item_image: item.image,
            quantity: 1,
            status: "pending",
        };
        appendOrder(perOrder);
        fetchToSession(perOrder);
    });
});

//cancel order (CustomerOrderController)
let cancelBtn = document.querySelector(".cancel-btn");
cancelBtn.addEventListener("click", function () {
    let confirmBox = confirm("Are you sure?");
    if (confirmBox) {
        orderContainer.style.display = "none";
        displayContainer.style.width = "100%";
        let data = {
            _token: token,
            remove: "Remove order from session",
        };
        fetchToSession(data);
    } else {
        console.log("Do not remove");
    }
});

//confirm order to (OrderController)
let confirmOrder = document.querySelector(".frm-confirm-order");
if (confirmOrder !== null) {
    confirmOrder.addEventListener("click", function (e) {
        e.preventDefault();

        fetch("/orders", {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "POST",
            body: JSON.stringify({ _token: token }),
        }).then((res) => {
            res.text().then((res) => {
                console.log(res);
                if (res == "Order Successful") {
                    window.location.reload();
                } else {
                    alert("Sorry we can't process your order!");
                }
            });
        });
    });
}

//will see if has order
let divTotal = document.querySelector(".div-total");
let arrayOfOrders;
if (orderContainer !== null) {
    arrayOfOrders = JSON.parse(
        document.querySelector(".div-for-order").getAttribute("data-has-order")
    );
} else {
    ordearrayOfOrdersrs = [];
}

//screen width
let screenWidth = window.screen.width;
console.log(screenWidth);

function hasOrder() {
    console.log(arrayOfOrders);
    if (arrayOfOrders.length !== 0) {
        console.log(screenWidth);
        if (screenWidth <= 991) {
            displayContainer.style.width = "70%";
            orderContainer.style.width = "30%";
            orderContainer.style.display = "block";
            orderContainer.style.zIndex = 0;
        } else {
            displayContainer.style.width = "80%";
            orderContainer.style.width = "18.5%";
            orderContainer.style.display = "block";
            orderContainer.style.zIndex = 100;
        }
    } else {
        displayContainer.style.width = "100%";
        orderContainer.style.display = "none";
        divTotal.textContent = "TOTAL : " + 00;
    }
}
hasOrder();
setInterval(function () {
    if (screenWidth == window.screen.width) {
        return;
    }
    screenWidth = window.screen.width;
    console.log("screen size has changed");
    hasOrder();
}, 1000);

//append order frontend
function appendOrder(order) {
    let flag;
    //mag hahanap if may existing order
    arrayOfOrders.forEach((existingOrder, index) => {
        if (existingOrder.item_id == order.item_id) {
            existingOrder.quantity += order.quantity;
            flag = existingOrder;
        }
    });
    //may nahanap existing order
    if (flag) {
        console.log("may nahanap");
        let itemToModify = document.getElementById("quantity-" + flag.item_id);
        itemToModify.textContent = "Quantity " + flag.quantity;

        //ipush ulit yung existing order
        arrayOfOrders = arrayOfOrders.filter((filtered) => {
            return filtered.item_id !== flag.item_id;
        });
        arrayOfOrders.push(flag);
        let total = 0;
        arrayOfOrders.forEach((freshOrder) => {
            total += freshOrder.quantity * 1 * freshOrder.item_price;
        });
        console.log(total);
        divTotal.textContent = "TOTAL : " + total;
    } else {
        //wala nahanap, append
        divTotal.textContent =
            "TOTAL : " +
            (divTotal.textContent.slice(8) * 1 + order.item_price * 1);
        console.log(divTotal.textContent);
        arrayOfOrders.push(order);
        let mainDivOrder = document.querySelector(".div-for-order");
        let divPerOrderContainer = document.createElement("div");
        divPerOrderContainer.classList.add(
            "div-per-order-container",
            "x-btn-" + order.item_id
        );

        let divPerOrder = document.createElement("div");
        divPerOrder.classList.add("div-per-order");

        let divForImgOrder = document.createElement("div");
        divForImgOrder.classList.add("div-for-img-order");
        let imgOrder = document.createElement("img");
        imgOrder.classList.add("img-order");
        imgOrder.src = order.item_image;

        let divOrderDetails = document.createElement("div");
        divOrderDetails.classList.add("div-order-details");

        let divOrdeDescription = document.createElement("div");
        divOrdeDescription.classList.add("div-order-description");
        let divRemoveOrder = document.createElement("div");

        divRemoveOrder.classList.add("div-remove-order");
        let xBtn = document.createElement("button");
        xBtn.id = order.item_id;
        xBtn.textContent = "...";
        xBtn.addEventListener("mouseout", () => {
            xBtnMouseout(xBtn);
        });
        xBtn.addEventListener("mouseover", () => {
            xBtnMouseover(xBtn);
        });
        xBtn.addEventListener("click", () => {
            xBtnClick(xBtn);
        });
        let itemName = document.createElement("p");
        itemName.textContent = order.item_name;
        itemName.classList.add("p-text");
        let itemPrice = document.createElement("p");
        itemPrice.textContent = order.item_price;
        itemPrice.classList.add("p-text");
        let itemQuantity = document.createElement("p");
        itemQuantity.textContent = "Quantity " + order.quantity;
        itemQuantity.classList.add("p-text");
        itemQuantity.id = "quantity-" + order.item_id;
        console.log("sa una");
        let divRestoNameOrder = document.createElement("div");
        divRestoNameOrder.classList.add("div-resto-name-order");
        divRestoNameOrder.textContent = "Prepared @ " + order.resto_name;

        //appending here
        divRemoveOrder.append(xBtn);
        divOrdeDescription.append(
            divRemoveOrder,
            itemName,
            itemPrice,
            itemQuantity
        );
        divOrderDetails.append(divOrdeDescription);
        divForImgOrder.append(imgOrder);
        divPerOrder.append(divForImgOrder, divOrderDetails, divRestoNameOrder);
        divPerOrderContainer.append(divPerOrder);
        mainDivOrder.append(divPerOrderContainer);
        hasOrder();
    }
}

//remove order
let xBtns = document.querySelectorAll(".x-btn");
xBtns.forEach((btn) => {
    btn.addEventListener("mouseout", () => {
        xBtnMouseout(btn);
    });
    btn.addEventListener("mouseover", () => {
        xBtnMouseover(btn);
    });
    btn.addEventListener("click", () => {
        xBtnClick(btn);
    });
});

//for remove(x-btn)
function xBtnMouseover(btn) {
    btn.textContent = "x";
    btn.style.color = "maroon";
    btn.style.border = "none";
    btn.style.outline = "none";
}
function xBtnMouseout(btn) {
    btn.textContent = "...";
    btn.style.color = "lightgray";
}
function xBtnClick(btn) {
    console.log(btn.id);
    let divContainer = document.querySelector(".x-btn-" + btn.id);
    let mainDivOrder = document.querySelector(".div-for-order");
    mainDivOrder.removeChild(divContainer);

    //nereremove ang order item
    arrayOfOrders.forEach((order, index) => {
        if (order.item_id == btn.id) {
            arrayOfOrders.splice(index, 1);
            hasOrder();
        }
    });
    if (arrayOfOrders.length !== 0) {
        let total = 0;
        arrayOfOrders.forEach((order) => {
            total += order.quantity * 1 * order.item_price;
        });
        divTotal.textContent = "TOTAL : " + total;
    }
    //update session when removing order (CustomerOrderController)
    fetch("/customers/removeorder", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        body: JSON.stringify({
            item_id: btn.id,
        }),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
        });
    });
}
