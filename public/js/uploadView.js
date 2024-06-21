// formulario general
const form = document.getElementById("filesForm");


// Obtener el numero de socios que se tienen registrados en la base de datos
const hiddenInput = document.getElementById("sociosNumero")


// funcion para agregar un conjunto de inputs equivalentes a un nuevo socio
function addPartnerField() { 

  var socioCount = form.getElementsByClassName('socioWrapper').length;

  // Create a new socioWrapper div
  var newSocioDiv = document.createElement('div');
  newSocioDiv.className = 'socioWrapper';
  newSocioDiv.innerHTML = `
    <div class="partnerTitle">
      <h3>Socio ${socioCount + 1} </h3>
    </div>

    <div class="formField">
      <label for="partenerName${socioCount + 1}">Nombre del socio</label>
      <input required type="text" name="partnerName${socioCount + 1}" id="partnerName${socioCount + 1}">
    </div>

    <div class="formField">
      <label for="comprobanteDomicilio${socioCount + 1}">Comprobante de domicilio</label>
      <input required type="file" name="comprobanteDomicilio${socioCount + 1}" id="comprobanteDomicilio${socioCount + 1}" accept="application/pdf">
    </div>

    <div class="formField">
      <label for="actaNacimiento${socioCount + 1}">Acta de nacimiento</label>
      <input required type="file" name="actaNacimiento${socioCount + 1}" id="actaNacimiento${socioCount + 1}" accept="application/pdf">
    </div>

    <div class="formField">
      <label for="ine${socioCount + 1}">INE del socio</label>
      <input required type="file" name="ine${socioCount + 1}" id="ine${socioCount + 1}" accept="application/pdf">
    </div>

    <div class="formField">
      <label for="actaMatrimonio${socioCount + 1}">Acta de matrimonio</label>
      <input required type="file" name="actaMatrimonio${socioCount + 1}" id="actaMatrimonio${socioCount + 1}" accept="application/pdf">
    </div>

    <div class="formField">
      <label for="constanciaSituacionFiscal${socioCount + 1}">Constancia situacion fiscal</label>
      <input required type="file" name="constanciaSituacionFiscal${socioCount + 1}" id="constanciaSituacionFiscal${socioCount + 1}" accept="application/pdf">
    </div>
  `;

  hiddenInput.value = socioCount + 1

  form.appendChild(newSocioDiv); // Append the new div to the form

  console.log(`Número de socios ${hiddenInput.value}`)
}


// funcion para borrar un conjunto de inputs equivalente a un nuevo socio
function erasePartnerField() {
  var socioCount = form.getElementsByClassName('socioWrapper').length;
  numeroSocios = document.getElementById('sociosNumero').getAttribute('num-socios')

  if(numeroSocios == 0) {
    if(socioCount > 2) {
      form.getElementsByClassName('socioWrapper').item(socioCount-1).remove()
      hiddenInput.value = socioCount - 1
    }
    else {
      alert("Necesitas mínimo dos socios");
    }
  }
  else {
      form.getElementsByClassName('socioWrapper').item(socioCount-1).remove()
      hiddenInput.value = socioCount - 1
  }

  console.log(`Número de socios ${hiddenInput.value}`)
}


// Esto es para cerrar el modal
const closeModalBtn = document.querySelector('.entendidoBtn');
const modal = document.querySelector('#messageModal');

closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});