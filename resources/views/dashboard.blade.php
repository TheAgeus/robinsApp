<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/Dashboard/dashboard.css') }}">
  <title>Dashboard - {{auth()->user()->user}}</title>
</head>
<body>
  
  @if (auth()->user()->theme == "dark")
    <style>
    </style>
  @endif

  <div class="fullWrapper">
    <!-- Start Navbar -->
    <div class="nav"> 
      <div class="line">
        <div class="configuracion">
          <div class="config">
              {{strtoupper(substr(auth()->user()->user, 0, 2))}}
          </div>
        </div>
        <div class="title">Empresas</div>
      </div>
      <div class="line">
        <form method="POST" action="{{ route('logout') }}">
          <button class="btn" type="submit">
            Cerrar sesion
          </button>
        </form>
      </div>
    </div> 
    <!-- End Navbar -->

    <!-- Start Company List -->
    <div class="companyList"> 
      <div class="companyItem">
        <div class="companyPreviewLeft">
          <div class="companyStatus">
            <div class="dot"></div>
          </div>
          <div class="companyWords">
            <div class="companyName">
              Company Test Whith Long Title 02
            </div>
            <div class="regimenFiscal">
              Regimen: SDRL
            </div>
          </div>
        </div>
        <div class="companyPreviewRight">
          <div class="date">
            01/02/2024
          </div>
        </div>
      </div>
      <div class="companyItem">
        <div class="companyPreviewLeft">
          <div class="companyStatus">
            <div class="dot"></div>
          </div>
          <div class="companyWords">
            <div class="companyName">
              Company Test Whith Long Title 01
            </div>
            <div class="regimenFiscal">
              Regimen: ELOTRO
            </div>
          </div>
        </div>
        <div class="companyPreviewRight">
          <div class="date">
            01/02/2024
          </div>
        </div>
      </div>
      <div class="companyItem">
        <div class="companyPreviewLeft">
          <div class="companyStatus">
            <div class="dot"></div>
          </div>
          <div class="companyWords">
            <div class="companyName">
              Company Short
            </div>
            <div class="regimenFiscal">
              Regimen: SDRL
            </div>
          </div>
        </div>
        <div class="companyPreviewRight">
          <div class="date">
            01/02/2024
          </div>
        </div>
      </div>
      <div class="companyItem">
        <div class="companyPreviewLeft">
          <div class="companyStatus">
            <div class="dot"></div>
          </div>
          <div class="companyWords">
            <div class="companyName">
              Company With a Very Very but Very Long Long Name JAJAJAJA
            </div>
            <div class="regimenFiscal">
              Regimen: SDRL
            </div>
          </div>
        </div>
        <div class="companyPreviewRight">
          <div class="date">
            01/02/2024
          </div>
        </div>
      </div>
    </div> 
    <!-- End Company List -->
    
    <!-- Start Add Button -->
    <div class="addCompanyBtn">
      <button onclick="openModal()">Agregar empresa</button>
    </div>
    <!-- End Add Button -->

    <!-- START add company modal -->
    <div id="addCompanyModal" class="addCompanyModal hideFormAddCompanyModal">
      <form action="">
        <div class="formField left">
          <div onclick="closeModal()" class="closeBtn">
            <img src="{{ asset('imgs/reject.png') }}" alt="Close">
          </div>
        </div>
        <div class="formField">
          <label for="companyName">Nombre de la compañía:</label>
          <input type="text" name="companyName" id="companyName">
        </div>
        <div class="formField">
          <label for="regimen">Regimen de la compañía:</label>
          <select type="text" name="regimen" id="regimen">
            <option value="S.D.R.L">S.D.R.L</option>
            <option value="S.A.C.V">S.A.C.V</option>
          </select>
        </div>
        <div class="formField">
          <label for="rfc">Rfc de la compañía:</label>
          <input type="text" name="rfc" id="rfc">
        </div>
        <div class="formField">
          <label for="domicilioFiscal">Domicilio Fiscal:</label>
          <input type="text" name="domicilioFiscal" id="domicilioFiscal">
        </div>
        <div class="formField">
          <label for="nombreRepresentante">Nombre del representante:</label>
          <input type="text" name="nombreRepresentante" id="nombreRepresentante">
        </div>
        <div class="formField">
          <button class="btn enviarBtn">
            Enviar
          </button>
        </div>
      </form>
    </div>
    <!-- END add company modal -->
  </div>

  <script>
    const addCompanyFormModal = document.getElementById('addCompanyModal');
    
    function openModal() {
      addCompanyFormModal.classList.remove('hideFormAddCompanyModal');
      addCompanyFormModal.classList.add('showFormAddCompanyModal');
    }

    function closeModal() {
      addCompanyFormModal.classList.remove('showFormAddCompanyModal');
      addCompanyFormModal.classList.add('hideFormAddCompanyModal');
    }

  </script>

</body>
</html>