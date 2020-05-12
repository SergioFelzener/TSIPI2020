const menu_icon = document.querySelector('.menu-icon')
const nav_ul = document.querySelector('#navigation-links')

menu_icon.addEventListener('click', () => {

    nav_ul.classList.toggle('open')

})