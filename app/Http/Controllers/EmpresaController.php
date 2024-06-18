<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Socio;
use Illuminate\Support\Facades\URL;

class EmpresaController extends Controller
{
    public function create(Request $request)
    {
        // Validar los campos
        $validatedData = $request->validate([
            'nombreEmpresa' => 'required|string|unique:empresas,nombreEmpresa',
            'regimenEmpresa' => 'required|string',
            'rfcEmpresa' => 'required|string',
            'domicilioFiscalEmpresa' => 'required|string',
            'nombreRepresentanteEmpresa' => 'required|string'
        ]);

        // Crear la nueva empresa, y guardarla en la base de datos
        $empresa = new Empresa();
        $empresa->nombreEmpresa = $validatedData['nombreEmpresa'];
        $empresa->regimenEmpresa = $validatedData['regimenEmpresa'];
        $empresa->rfcEmpresa = $validatedData['rfcEmpresa'];
        $empresa->domicilioFiscalEmpresa = $validatedData['domicilioFiscalEmpresa'];
        $empresa->nombreRepresentanteEmpresa = $validatedData['nombreRepresentanteEmpresa'];
        $empresa->user_id = auth()->user()->id;
        $empresa->save();

        // Redireccionar o responder con un mensaje de éxito
        return redirect('/dashboard')->with('success', '¡Empresa creada con éxito!');
    }

    public function show($id) // company id
    {
        $empresa = Empresa::find($id);
        return view('dashboardEmpresa')->with('empresa', $empresa);
    }

    // Company form to add partners and upload files
    public function uploadLink($id) // company id
    {
        // Encontrar la empresa con el ID proporcionado
        $empresa = Empresa::find($id);

        if(request()->hasValidSignature()) 
        {
            return view('upload')->with([
                'empresaName' => $empresa->nombreEmpresa,
                'empresaId' => $empresa->id,
                'numeroSocios' => $empresa->numeroSocios()
            ]);
        }
        return "Ruta no encontrada :c";
    }

    public function generaLinkEmpresa(Request $request)
    {
        // Generar el enlace firmado
        $link = URL::signedRoute('uploadLink', ['id' => $request->idEmpresa]);

        // Encontrar la empresa con el ID proporcionado
        $empresa = Empresa::find($request->idEmpresa);

        // Redirigir de vuelta con los datos de la empresa y el enlace firmado
        return back()->with([
            'empresa' => $empresa,
            'link' => $link
        ]);
    }

    public function uploadFiles(Request $request)
    {
        $sociosNumero = $request->input('sociosNumero');
        $partnerData = [];

        for ($i = 0; $i < $sociosNumero; $i++) {
            // Handle text input
            $inputName = 'partnerName' . ($i + 1);
            if ($request->has($inputName)) {
                $socioName = $request->input($inputName);
                $partnerData[$i]['socioName'] = $socioName;
            }

            // Array of file fields to process
            $fileFields = [
                'comprobanteDomicilio' => 'comprobanteDomicilio',
                'actaNacimiento' => 'actaNacimiento',
                'ine' => 'ine',
                'actaMatrimonio' => 'actaMatrimonio',
                'constanciaSituacionFiscal' => 'constanciaSituacionFiscal'
            ];

            // Loop through file fields
            foreach ($fileFields as $key => $baseField) {
                $fieldName = $baseField . ($i + 1);

                if ($request->hasFile($fieldName)) {
                    $file = $request->file($fieldName);
                    $path = $file->getRealPath();
                    $doc = file_get_contents($path);
                    $base64 = base64_encode($doc);
                    $mime = $file->getClientMimeType();

                    // Store the processed file data in the partnerData array
                    $partnerData[$i][$key] = $base64;
                }
            }

            // Loop through partnerData and store it
            Socio::create([
                'empresa_id' =>  $request->empresaId,
                'nombre' => $partnerData[$i]['socioName'],
                'comprobanteDomicilioPdf' => $partnerData[$i]['comprobanteDomicilio'],
                'actaNacimientoPdf' => $partnerData[$i]['actaNacimiento'],
                'inePdf' => $partnerData[$i]['ine'],
                'actaMatrimonioPdf' => $partnerData[$i]['actaMatrimonio'],
                'constanciaSituacionFiscalPdf' => $partnerData[$i]['constanciaSituacionFiscal'],
            ]);
        }
    
        return back()->with('success', 'Documentos Almacenados');
    }


}

