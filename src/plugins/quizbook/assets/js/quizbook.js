const respuestas = document.querySelectorAll(".quizbook_respuesta");
const btnEnviar = document.querySelector("#quizbook_btnSubmit");

btnEnviar.addEventListener("click", handleSubmitForm);

respuestas.forEach((respuesta) => {
  respuesta.addEventListener("click", handleClickRespuesta);
});

function handleClickRespuesta(event) {
  const [idQuiz, idRespuesta] = event.target.id.split(":");
  selectedRespuesta(idQuiz, event);
}

function selectedRespuesta(id, event) {
  respuestas.forEach((respuesta) => {
    if (respuesta.id.startsWith(id)) {
      respuesta.classList.remove("selected");
      respuesta.dataset.selected = false;
    }
  });
  event.target.classList.add("selected");
  event.target.dataset.selected = true;
}

function handleSubmitForm(event) {
  event.preventDefault();
  const formRespuestas = new Map();
  const respuestasSeleccionadas = document.querySelectorAll(
    '[data-selected*="true"]'
  );
  respuestasSeleccionadas.forEach((respuesta) => {
    const [idQuiz, idRespuesta] = respuesta.id.split(":");
    /* formRespuestas.push(`${idQuiz}:${idRespuesta}`); */
    formRespuestas.set(idQuiz, idRespuesta);
    /* formRespuestas[idQuiz] = idRespuesta; */
  });
  sendForm(formRespuestas);
}

function sendForm(formRespuestas) {
  /* const data = {
    data: formRespuestas,
    action: "quizbook_resultados",
  }; */

  const formData = new FormData();

  formData.append("action", "quizbook_resultados");
  formRespuestas.forEach((value, key) => {
    formData.append(`resultados[${key}]`, value);
  });

  const url = admin_url.ajax_url; // viende del archivo scripts.php -> wp_localize_script

  console.log(formRespuestas);
  console.log(url);

  fetch(url, {
    method: "POST",
    credentials: "same-origin",
    /*  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
      "Content-Type": "application/json",
      "Cache-Control": "no-cache",
    }, */
    /* body: new URLSearchParams(data), */
    /* body: JSON.stringify(data), */
    body: formData,
  })
    .then((response) => response.json())
    .then((response) => console.log(response))
    .catch((err) => console.log(err));
}
