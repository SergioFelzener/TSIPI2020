const menu_icon = document.querySelector('.menu-icon')
const nav_ul = document.querySelector('ul')

menu_icon.addEventListener('click', () => {

    nav_ul.classList.toggle('open')

})