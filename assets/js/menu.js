const subMenus = document.querySelectorAll("#activar--menu");
const mostrarSubMenu = document.querySelectorAll(".lista_submenu_mostrar");

window.addEventListener("DOMContentLoaded", () => {
  subMenus.forEach((menu, i) => {
    menu.addEventListener("click", (e) => {
      mostrarSubMenu[i].classList.toggle("lista_submenu_mostrar--activo");
    });
  });
});
