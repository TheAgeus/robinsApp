<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/Dashboard/dashboardEmpresa.css') }}">
  <title>RobinsApp Dashboard - {{auth()->user()->user}} - {{ $empresa->nombreEmpresa }}</title>
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
        <div class="title">Empresa - {{ $empresa->nombreEmpresa }}</div>
      </div>
      <div class="line">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn" type="submit">
            Cerrar sesion
          </button>
        </form>
        <div class="btn">
          <a href="{{ url('/dashboard') }}" class="btn">Regresar al Dashboard</a>
        </div>
      </div>
    </div> 
    <!-- End Navbar -->

    <!-- Start Company Socio List -->
    <div class="companyList"> 
      {{-- Check if socios data is available --}}
      @if($empresa->numeroSocios() > 0)
        @foreach($empresa->socios() as $socio)
          <div class="companyItem" data-id="{{ $socio->id }}">
            <div class="companyPreviewLeft">
              <div class="companyStatus">
                <div class="dot"></div>
              </div>
                <div class="companyWords">
                  <div class="companyName">
                    {{ $socio->nombre }}
                  </div>
                </div>
            </div>
          </div>
        @endforeach
      @else
        <p>No socios found.</p>
      @endif
    </div> 
    <!-- End Company List -->
    
    <!-- Start Add Button -->
    <div class="addCompanyBtn">
      <form action="{{ route('generaLinkEmpresa') }}" method="POST">
        @csrf
        <input type="hidden" name="idEmpresa" value="{{ $empresa->id }}">
        <button onclick="openModal()">Generar link</button>
      </form>
    </div>
    <!-- End Add Button -->

    <!-- START message modal -->
    @if ($errors->any() || session('success') || session('link'))
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

          <!-- Mostrar mensaje del link si existe -->
          @if (session('link'))
            <h3 class="link">Link:</h3>
            <h4 class="link">{{ session('link') }}</h4>
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

  </script>

</body>
</html>