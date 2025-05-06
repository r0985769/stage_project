document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.hamburger-menu');
    const menu = document.querySelector('.region-navigation ul.menu');
  
    if (toggle && menu) {
      toggle.addEventListener('click', () => {
        menu.classList.toggle('show');
      });
    }
  });
  