import { registrar, eliminar, buscar } from "./funcionesGlobales.js";
const contenedor_cliente = document.querySelectorAll(".nuevo_cliente");
const contenedorBotones = document.getElementById("contenedor_botones");
const Buton = document.getElementById("buton");

const formularioCliente = document.getElementById("frmCliente");
const $ = (selector) => document.querySelectorAll(selector);
const $_ = (selector) => document.getElementById(selector);
window.addEventListener("load", () => {
  /*Ocultar Cotenedor */
  Buton.addEventListener("click", (e) => {
    e.preventDefault();
    contenedor_cliente[0].classList.toggle("d-none");
    Buton.classList.toggle("d-none");
    contenedorBotones.classList.toggle("d-none");
    $("#tabla_cliente")[0].classList.toggle("d-none");
  });

  /*Boton cancelar */
  $("#btnCancelar")[0].addEventListener("click", (e) => {
    e.preventDefault();
    window.location.reload();
  });

  /*Crear Clientes*/
  formularioCliente.addEventListener("submit", async (e) => {
    e.preventDefault();
    const frmdata = new FormData(formularioCliente);
    const url = "/ruta/clientes/registrar";
    registrar(url, frmdata, "Registrar");
  });

  /*Buscar Clientes*/
  $_("input-buscar-cliente").addEventListener("keyup", async (e) => {
    e.preventDefault();
    const url = "/ruta/clientes/buscar";
    const numero = e.target.value;
    if (numero == "") {
      location.href = "/ruta/clientes";
      return;
    }
    const datos = await buscar(url, JSON.stringify({ cedula: numero }));
    let tr = "";
    datos.forEach((dato) => {
      tr += `<tr>
      <td>${dato.ID_CLIENTE}</td>
      <td> ${dato.NOMBRE}</td>
      <td> ${dato.APELLIDOS}</td>
      <td> ${dato.CEDULA}</td>
      <td> ${dato.NOMBRE_BARRIO}</td>
      <td>
          <button class="btn text-primary">Editar</button>
          |
          <button class="btn text-danger" id="btnEliminarCliente">Eliminar</button>
      </td>
    </tr>`;
    });
    $_("tBody").innerHTML = tr;
    $("#btnEliminarCliente").forEach((btn) => {
      eliminarBtn(btn);
    });
  });
  /*Eliminar Clientes */
  const eliminarBtn = (btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const url = "/ruta/clientes/eliminar";
      const idCliente = parseInt(
        e.target.parentNode.parentNode.childNodes[1].textContent
      );
      eliminar(url, idCliente, "Eliminado");
    });
  };

  $("#btnEliminarCliente").forEach((btn) => {
    eliminarBtn(btn);
  });
  $_("telefono").addEventListener("keypress", (e) => {
    let isNumber = window.event ? e.which : e.keyCode;
    if (isNumber < 48 || isNumber > 57) {
      e.preventDefault();
    }
  });
  $_("cedula").addEventListener("keypress", (e) => {
    let isNumber = window.event ? e.which : e.keyCode;
    if (isNumber < 48 || isNumber > 57) {
      e.preventDefault();
    }
  });
});
