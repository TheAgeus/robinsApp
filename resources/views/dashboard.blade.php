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
          @csrf
          <button class="btn" type="submit">
            Cerrar sesion
          </button>
        </form>
      </div>
    </div> 
    <!-- End Navbar -->

    <!-- Start Company List -->
    <div class="companyList"> 
      {{-- Check if empresas data is available --}}
      @if(isset($empresas) && $empresas->count() > 0)
        @foreach($empresas as $empresa)
          <div class="companyItem" data-id="{{ $empresa->id }}">
            <div class="companyPreviewLeft">
              <div class="companyStatus">
                <div class="dot"></div>
              </div>
                <div class="companyWords">
                  <div class="companyName">
                    {{ $empresa->nombreEmpresa }}
                  </div>
                  <div class="regimenFiscal">
                    Regimen: {{ $empresa->regimenEmpresa }}
                  </div>
                </div>
            </div>
            <div class="companyPreviewRight">
              <div class="date">
                {{ $empresa->created_at }} {{-- Replace with the actual date field from your empresa --}}
              </div>
              <div class="socios">
                Socios: {{ $empresa->numeroSocios() }}
              </div>
            </div>
          </div>
        @endforeach
      @else
        <p>No empresas found.</p>
      @endif
    </div> 
    <!-- End Company List -->
    
    <!-- Start Add Button -->
    <div class="addCompanyBtn">
      <button onclick="openModal()">Agregar empresa</button>
    </div>
    <!-- End Add Button -->

    <!-- START add company modal -->
    <div id="addCompanyModal" class="addCompanyModal hideFormAddCompanyModal">
      <form method="POST" action="{{ route('empresas/create') }}">
        @csrf      
        <div class="formField left">
          <div onclick="closeModal()" class="closeBtn">
            <img src="{{ asset('imgs/reject.png') }}" alt="Close">
          </div>
        </div>
        <div class="formField">
          <label for="nombreEmpresa">Nombre de la compañía:</label>
          <input type="text" name="nombreEmpresa" id="nombreEmpresa">
        </div>
        <div class="formField">
          <label for="regimenEmpresa">Regimen de la compañía:</label>
          <select type="text" name="regimenEmpresa" id="regimenEmpresa">
            <option value="S.D.R.L">S.D.R.L</option>
            <option value="S.A.C.V">S.A.C.V</option>
          </select>
        </div>
        <div class="formField">
          <label for="rfcEmpresa">Rfc de la compañía:</label>
          <input type="text" name="rfcEmpresa" id="rfcEmpresa">
        </div>
        <div class="formField">
          <label for="domicilioFiscalEmpresa">Domicilio Fiscal:</label>
          <input type="text" name="domicilioFiscalEmpresa" id="domicilioFiscalEmpresa">
        </div>
        <div class="formField">
          <label for="nombreRepresentanteEmpresa">Nombre del representante:</label>
          <input type="text" name="nombreRepresentanteEmpresa" id="nombreRepresentanteEmpresa">
        </div>
        <div class="formField">
          <button class="btn enviarBtn">
            Enviar
          </button>
        </div>
      </form>
    </div>
    <!-- END add company modal -->
    <!-- START message modal -->
    <!-- Modal para mensajes -->
    @if ($errors->any() || session('success'))
      <div class="messageModal" id="messageModal">
        <div class="alert {{ $errors->any() ? 'alert-danger' : 'alert-success' }}">
          <!-- Mostrar errores si existen -->
          @if ($errors->any())
            <h3>Se encontraron los siguientes errores:</h3>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          
          <!-- Mostrar mensaje de éxito si existe -->
          @if (session('success'))
            <h3>{{ session('success') }}</h3>
          @endif

          <!-- Botón Entendido -->
          <div class="entendidoBtn" data-dismiss="modal">
            Entendido
          </div>
        </div>
      </div>
    @endif
    <!-- END message modal -->
  </div>

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    const closeModalBtn = document.querySelector('.entendidoBtn');
    const modal = document.querySelector('#messageModal');
    
    if (closeModalBtn && modal) {
      closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });
    }

    $(document).ready(function() {
        // Attach click event handler to companyItem elements
        $('.companyItem').on('click', function() {
            // Get the data-id attribute value (which is empresa ID)
            var empresaId = $(this).data('id');
            
            // Redirect to /dashboard/{id_empresa}
            window.location.href = '/dashboard/empresa/' + empresaId;
        });
    });

  </script>

</body>
</html>