const $ = (selector) => document.querySelectorAll(selector);
const $_ = (selector) => document.getElementById(selector);
document.addEventListener("DOMContentLoaded", () => {
  let idCliente = "";

  const btnEliminar = (i) => {
    const datos = {
      id: $("#buscar-id-cliente-lectura")[i].textContent,
      cedula: $("#buscar-cedula-lectura")[i].textContent,
      nMedidor: $("#buscar-id-numero-medidor-lectura")[i].textContent,
      nombre: $("#buscar-id-nombres-lectura")[i].textContent,
    };
    $_("idCliente").value = datos.id;
    $_("cedula").value = datos.cedula;
    $_("cliente").value = datos.nombre;
    $_("numero-medidor").value = datos.nMedidor;
    const isActive = $_(
      "registro-lectura-tablas--contenedor"
    ).classList.contains("d-none");
    if (!isActive) {
      $_("registro-lectura-tablas--contenedor").classList.add("d-none");
    }
  };

  const alertaSweet = (create, msj) => {
    if (!create) {
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "Error",
        text: msj,
        showConfirmButton: false,
        timer: 2500,
      });
      return;
    }
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Registro",
      text: msj,
      showConfirmButton: false,
      timer: 2500,
    });
    setTimeout(() => {
      window.location.reload();
    }, 2500);
  };

  /*Boton Generar Factura*/
  $("#btn-lectura-pagar").forEach((btn, i) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      idCliente = $("#tabla-id")[i].textContent;
      /*Cargar datos del cleinte selecioando */
      fetch("/ruta/lecturas/cargarlectura", {
        method: "POST",
        body: JSON.stringify({ id: idCliente }),
      })
        .then((resp) => resp.json())
        .then((data) => {
          $_("input-lectura-anterior").value = data.lectura;
        });
      $_("contenedor-lecturas").classList.toggle("d-none");
      /*Registrar lectura */
      $_("btn-frm-lecturas").addEventListener("click", async (e) => {
        e.preventDefault();
        const frmData = new FormData($_("frm-lectura"));
        frmData.append("idCliente", idCliente);
        if (frmData.get("lecturaActual") <= frmData.get("consumo")) {
          Swal.fire({
            title: "Error",
            icon: "info",
            text: "la lectura actual no puede ser menor o igual a la anterior...",
            background: "#F1948A",
          });

          return;
        }
        const req = await fetch("/ruta/lecturas/guardar", {
          method: "POST",
          body: frmData,
        });
        const { create, msj } = await req.json();
        alertaSweet(create, msj);
      });
    });
  });

  /*Cerra Ventana*/
  $_("lectura-cerrar-ventana").addEventListener("click", (e) => {
    e.preventDefault();
    $_("contenedor-lecturas").classList.toggle("d-none");
  });

  /*Crear neuva lectura */
  $_("nueva-lectura").addEventListener("click", (e) => {
    e.preventDefault();
    $_("registro-lectura").classList.toggle("d-none");
    $_("contenedor-clientes-lectura").classList.toggle("d-none");

    /*Buscar Cliente*/
    $_("buscar-cliente-lectura").addEventListener("click", (e) => {
      e.preventDefault();
      $_("registro-lectura-tablas--contenedor").classList.toggle("d-none");

      /*Buscar clientes en lecturas activar estado*/
      $_("input-buscar-clientes-lectura").addEventListener(
        "keyup",
        async (e) => {
          e.preventDefault();
          const inputBscar = e.target.value;
          const req = await fetch("/ruta/lecturas/buscarPorAny", {
            method: "POST",
            body: JSON.stringify({ nombre: inputBscar }),
          });
          const data = await req.json();
          if (data != null) {
            let tr = "";
            tr = `  <tr>
                <td id="buscar-id-cliente-lectura">${data.ID_CLIENTE}</td>
                <td id="buscar-cedula-lectura">${data.CEDULA}</td>
                <td id="buscar-id-numero-medidor-lectura">${data.N_MEDIDOR}</td>
                <td id="buscar-id-nombres-lectura">${data.NOMBRE}  ${data.APELLIDOS}</td>
                <td id=""><button id="btn-obtener-cliente-lectura" class="btn btn-primary"><i class="fa-solid fa-rotate-right"></i></button></td>
              </tr>`;
            $_("tbody-clientes-lecturas").innerHTML = tr;
            $("#btn-obtener-cliente-lectura").forEach((btn, i) => {
              btn.addEventListener("click", (e) => {
                e.preventDefault();
                btnEliminar(i);
              });
            });
          }
        }
      );

      /*Cerrar ventana buscar clientes*/
      $_("btn-contenedor-buscar-cliente").addEventListener("click", (e) => {
        const ventanaActiva = $_(
          "registro-lectura-tablas--contenedor"
        ).classList.contains("d-none");
        if (!ventanaActiva) {
          $_("registro-lectura-tablas--contenedor").classList.add("d-none");
        }
      }); /*Final de cerrar buscador clientes */
      $("#btn-obtener-cliente-lectura").forEach((btn, i) => {
        btn.addEventListener("click", (e) => {
          e.preventDefault();
          btnEliminar(i);
          /*Formulario lectura */
          $_("frm-lecturas").addEventListener("submit", async (e) => {
            e.preventDefault();
            const frm = new FormData($_("frm-lecturas"));
            const req = await fetch("/ruta/lecturas/guardarLecturaInicial", {
              method: "POST",
              body: frm,
            });
            const { create, msj } = await req.json();
            alertaSweet(create, msj);
          });
        });
      });
    });
  });
});
