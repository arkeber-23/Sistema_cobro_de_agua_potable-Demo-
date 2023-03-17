const $ = (selector) => document.getElementById(selector);
const formularioCliente = document.getElementById("frmCliente");

formularioCliente.addEventListener("submit", async (e) => {
  e.preventDefault();
  const frmData = new FormData(formularioCliente);
  const datos = {
    id: frmData.get("idCliente"),
    nombre: frmData.get("nombre"),
    apellidos: frmData.get("apellidos"),
    telefono: frmData.get("telefono"),
    correo: frmData.get("correo"),
    cedula: frmData.get("cedula"),
    nMedidor: frmData.get("n_medidor"),
    barrio: frmData.get("barrio"),
  };
  const res = await fetch("/ruta/clientes/actualizar", {
    method: "PUT",
    body: JSON.stringify(datos),
  });
  const { update, msj } = await res.json();
  if (!update) {
    Swal.fire({
      title: "Error!",
      icon: "error",
      text: msj,
    });
    return;
  }
  Swal.fire({
    title: "Ok!",
    text: msj,
    icon: "success",
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
  });
  setTimeout(() => {
    location.href = "/ruta/clientes";
  }, 1500);
});

$("btnCancelar").addEventListener("click", (e) => {
  e.preventDefault();
  location.href = "/ruta/clientes";
});
