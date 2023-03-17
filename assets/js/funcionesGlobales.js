const urlBase = "/ruta/clientes";
const alertSweet = (create, msj, title) => {
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
    title: title,
    text: msj,
    showConfirmButton: false,
    timer: 2500,
  });
  setTimeout(() => {
    window.location.href = urlBase;
  }, 2500);
};

const registrar = async (url, frmData, title) => {
  const req = await fetch(url, {
    method: "POST",
    body: frmData,
  });

  const { create, msj } = await req.json();
  alertSweet(create, msj, title);
};

const buscar = async (url, cedula) => {
  const req = await fetch(url, {
    method: "POST",
    body: cedula,
  });
  return await req.json();
};
const eliminar = async (url, idCliente, title) => {
  Swal.fire({
    title: "¿Está seguro que dese eliminar este cliente?",
    text: "esta acción es irreversible…",
    showDenyButton: true,
    confirmButtonText: "Si, Eliminar",
    denyButtonText: "Cancelar",
    denyButtonColor: "#CB4335",
  }).then(({ isConfirmed }) => {
    if (isConfirmed) {
      Swal.fire("Saved!", "", "success");
      fetch(url, {
        method: "POST",
        body: JSON.stringify({ id: idCliente }),
      })
        .then((resp) => resp.json())
        .then(({ create, msj }) => {
          alertSweet(create, msj, title);
        });
    }
  });
};

export { registrar, buscar, eliminar };
