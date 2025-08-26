/**
 * grinviro js
 * @author: Nandangpy
 * @version: 1.9.26 - 2024-12-20 GMT 2:00 PM
 **/
window.addEventListener("load", function () {
    const loadingScreen = document.getElementById("loading-screen");
    setTimeout(function () {
        if (loadingScreen) {
            loadingScreen.style.display = "none";
        }
    }, 500);
});

document.addEventListener("DOMContentLoaded", function () {
    const menuProduk = document.getElementById("menu-produk");
    const submenuProduk = document.getElementById("submenu-produk");

    // Toggle submenu visibility
    menuProduk.addEventListener("click", function (e) {
        e.preventDefault();
        submenuProduk.classList.toggle("d-none");
        menuProduk.parentElement.classList.toggle("open"); // Rotate arrow
    });

    // Close submenu on outside click
    document.addEventListener("click", function (e) {
        if (
            !menuProduk.contains(e.target) &&
            !submenuProduk.contains(e.target)
        ) {
            submenuProduk.classList.add("d-none");
            menuProduk.parentElement.classList.remove("open");
        }
    });
});
