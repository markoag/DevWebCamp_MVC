(function () {
  const tagsInput = document.querySelector("#tags_input");

  if (tagsInput) {
    const tagsDiv = document.querySelector("#tags");
    const tagsInputHidden = document.querySelector("[name='tags']");

    let tags = [];

    // Recuperar del input hidden los tags que ya existen
    if (tagsInputHidden.value) {
      tags = tagsInputHidden.value.split(",");      
      mostrarTags();
    }

    // Escuchar los cambios en el input
    tagsInput.addEventListener("keyup", guardarTag);    

    function guardarTag(e) {      
        if (e.keyCode === 188) {
            let inputValue = e.target.value.trim();
            if (inputValue === "" || inputValue < 1) {
              return;
            }
            e.preventDefault();
            // Si el último carácter es una coma, lo eliminamos
            if (inputValue.endsWith(",")) {
              inputValue = inputValue.slice(0, -1);
            }
            tags = [...tags, inputValue];
            tagsInput.value = "";
        
            mostrarTags();
          }
    }

    function mostrarTags() {
      tagsDiv.textContent = "";
      tags.forEach((tag) => {
        const etiqueta = document.createElement("LI");
        etiqueta.classList.add("formulario__tag");
        etiqueta.textContent = tag;
        etiqueta.ondblclick = eliminarTag;
        tagsDiv.appendChild(etiqueta);
      });

      actualizarInputHidden();
    }

    function eliminarTag(e) {
      e.target.remove();
      tags = tags.filter((t) => t !== e.target.textContent);

      actualizarInputHidden();
    }

    function actualizarInputHidden() {
      tagsInputHidden.value = tags.join(",");
    }
  }
})();
