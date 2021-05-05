const token = document.querySelector('meta[name="csrf-token"]').content;
let userId = document.querySelector('meta[name="user"]').content;

let divForDisplayOrders = document.querySelector(".div-for-display-orders");
// TO DO NOT DISPLAY DIVS WITH OUT ORDER
let groupOrders = document.querySelectorAll(".div-group-order");
let has = false;
let orderText = document.querySelector("#order-text");
groupOrders.forEach((each) => {
    // console.log(each.textContent.trim());
    if (each.textContent.trim() == "Accept") {
        each.style.display = "none";
    } else {
        has = true;
    }
});
if (!has) {
    orderText.textContent = "NO ORDER";
} else {
    // setInterval((i) => {
    //     window.location.reload();
    // }, 10000);
}

//accept order here
let acceptBtns = document.querySelectorAll(".accept-btn");
acceptBtns.forEach((acceptBtn) => {
    acceptBtn.addEventListener("click", function () {
        let orderId = acceptBtn.getAttribute("data-group-orderId");
        // alert(orderId);
        let groupOfOrder = document.getElementById("group-order-" + orderId);
        let items = groupOfOrder.querySelectorAll(".item-name");
        items.forEach((item) => {
            let itemId = item.getAttribute("data-item-name");
            console.log(itemId);
            fetch("/order_items/" + itemId, {
                //nasa line 185
                headers: {
                    "Content-Type": "application/json",
                },
                method: "PUT",
                body: JSON.stringify({
                    _token: token,
                    status: "preparing",
                }),
            }).then((res) => {
                res.text().then((res) => {
                    console.log(res);
                    alert(res);
                    if (res !== "Sorry, no active rider!") {
                        let riderId = res.slice(21, 22);
                        acceptBtn.textContent = "Accepted";
                        acceptBtn.style.backgroundColor = "whitesmoke";
                        acceptBtn.disabled = "true";
                        //this is to update the rider that is being booked
                        fetch("/riders/" + riderId, {
                            //nasa line 185
                            headers: {
                                "Content-Type": "application/json",
                            },
                            method: "PUT",
                            body: JSON.stringify({
                                _token: token,
                                status: "driving",
                            }),
                        }).then((res) => {
                            res.text().then((res) => {
                                // alert(res);
                                console.log(res);
                                // window.location.reload();
                            });
                        });
                    }
                    // window.location.reload();
                });
            });
        });
    });
});

//click image to cancel
let imgs = document.querySelectorAll(".img-order");
imgs.forEach((img) => {
    img.addEventListener("click", function () {
        let itemId = img.getAttribute("data-item-id"); //id sa items table
        let itemOrderId = img.getAttribute("data-order-item-id"); //id sa order_items table
        // alert(itemId);
        let option = document.getElementById("option-" + itemOrderId);
        if (option.style.display == "block") {
            option.style.display = "none";
        } else {
            option.style.display = "block";
        }
    });
});
