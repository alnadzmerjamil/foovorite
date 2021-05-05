const token = document.querySelector('meta[name="csrf-token"]').content;
let frmAddCategory = document.querySelector(".frm-add-category");
let inputCategory = document.querySelector(".ipt-category");
let saveBtn = frmAddCategory.querySelector(".save-btn");

// ADD CATEGORY
frmAddCategory.addEventListener("submit", (e) => {
    e.preventDefault();
    let inputCategoryValue = inputCategory.value;
    let firstLetter = inputCategoryValue.charAt(0).toUpperCase();
    let sliced = inputCategoryValue.slice(1);
    inputCategoryValue = firstLetter + sliced;
    console.log(inputCategoryValue);

    // return;

    fetch("/categories", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
        },
        method: "POST",
        body: JSON.stringify({
            _token: token,
            body: inputCategoryValue.trim(),
        }),
    }).then((res) => {
        res.text().then((res) => {
            console.log(res);
            inputCategory.value = "";
        });
    });
});

//EDIT OR DELETE CATEGORY
let spanCategories = document.querySelectorAll(".span-category");
spanCategories.forEach((category) => {
    category.addEventListener("click", () => {
        alert(category.textContent);
    });
});
