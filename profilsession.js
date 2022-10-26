let button = document.getElementById("button");
let form = document.getElementById("form");

button.addEventListener("click", () => {
    if (getComputedStyle(form).display != "none") {
        form.style.display = "none";
    } else {
        form.style.display = "block";
    }
})

