document.addEventListener("DOMContentLoaded", function () {
    const burger = document.getElementById("burger-menu");
    const nav = document.getElementById("nav-menu");

    burger.addEventListener("click", function () {
        burger.classList.toggle("open");
        nav.classList.toggle("open");
    });
});
