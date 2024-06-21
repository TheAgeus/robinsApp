<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/Upload/PartnerForm.css') }}">
  <title>RobinsApp - Upload Files</title>
</head>
<body>

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

  <div class="title">
    <h2>Socios de la empresa: {{ $empresaName }}</h2>
  </div>

  <form id="filesForm" action=" {{route('uploadFiles')}} " method="POST" enctype="multipart/form-data">
    @csrf

    <div id="numeroSociosActuall" num-socios="{{ $numeroSocios }}"></div>

    <input type="hidden" name="empresaId" id="empresaId" value="{{ $empresaId }}">

    @if( $numeroSocios == 0 )    
      <input type="hidden" name="sociosNumero" id="sociosNumero" value="2">
    @else
      <input type="hidden" name="sociosNumero" id="sociosNumero" value="1">
    @endif

    <div class="socioWrapper">
      <div class="partnerTitle">
        <h3>Socio 1 *</h3>
      </div>

      <div class="formField">
        <label for="partenerName1">Nombre del socio</label>
        <input required type="text" name="partnerName1" id="partnerName1">
      </div>

      <div class="formField">
        <label for="comprobanteDomicilio1">Comprobante de domicilio</label>
        <input required type="file" name="comprobanteDomicilio1" id="comprobanteDomicilio1" accept="application/pdf">
      </div>

      <div class="formField">
        <label for="actaNacimiento1">Acta de nacimiento</label>
        <input required type="file" name="actaNacimiento1" id="actaNacimiento1" accept="application/pdf">
      </div>

      <div class="formField">
        <label for="ine1">INE del socio</label>
        <input required type="file" name="ine1" id="ine1" accept="application/pdf">
      </div>

      <div class="formField">
        <label for="actaMatrimonio1">Acta de matrimonio</label>
        <input type="file" name="actaMatrimonio1" id="actaMatrimonio1" accept="application/pdf">
      </div>

      <div class="formField">
        <label for="constanciaSituacionFiscal1">Constancia situacion fiscal</label>
        <input required type="file" name="constanciaSituacionFiscal1" id="constanciaSituacionFiscal1" accept="application/pdf">
      </div>
    </div>
    
    @if ( $numeroSocios == 0 )
      <div class="socioWrapper">
        <div class="partnerTitle">
          <h3>Socio 2 *</h3>
        </div>

        <div class="formField">
          <label for="partenerName2">Nombre del socio</label>
          <input required type="text" name="partnerName2" id="partnerName2">
        </div>

        <div class="formField">
          <label for="comprobanteDomicilio2">Comprobante de domicilio</label>
          <input required type="file" name="comprobanteDomicilio2" id="comprobanteDomicilio2" accept="application/pdf">
        </div>

        <div class="formField">
          <label for="actaNacimiento2">Acta de nacimiento</label>
          <input required type="file" name="actaNacimiento2" id="actaNacimiento2" accept="application/pdf">
        </div>

        <div class="formField">
          <label for="ine2">INE del socio</label>
          <input required type="file" name="ine2" id="ine2" accept="application/pdf">
        </div>

        <div class="formField">
          <label for="actaMatrimonio2">Acta de matrimonio</label>
          <input required type="file" name="actaMatrimonio2" id="actaMatrimonio2" accept="application/pdf">
        </div>

        <div class="formField">
          <label for="constanciaSituacionFiscal2">Constancia situacion fiscal</label>
          <input required type="file" name="constanciaSituacionFiscal2" id="constanciaSituacionFiscal2" accept="application/pdf">
        </div>
      </div>
    @endif 
      
  </form>
  <div class="controls">
    <div onclick="addPartnerField()" class="add SocioBtn">
      Add Socio
    </div>
    <div onclick="erasePartnerField()" class="erase SocioBtn">
      Erase Socio
    </div>
    <button type="submit" form="filesForm" class="send SocioBtn">
      Enviar
    </button>
  </div>



  <script src="{{ asset('js/uploadView.js') }}"></script>
  

</body>
</html>