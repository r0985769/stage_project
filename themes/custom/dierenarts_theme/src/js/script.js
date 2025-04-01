document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.querySelector(".hamburger-menu"); // De hamburgerknop
    const menu = document.querySelector(".region-navigation ul.menu"); // Het menu

    if (menuButton && menu) {
        menuButton.addEventListener("click", function () {
            menu.classList.toggle("show"); // Toggle de 'show' klasse om het menu zichtbaar te maken
        });
    }
});
