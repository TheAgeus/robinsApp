<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;

class SocioController extends Controller
{
    public function showComprobanteDomicilio($id)
    {
        // Find the document by its ID
        $socio = Socio::findOrFail($id);

        // Decode the base64 encoded content
        $pdfContent = base64_decode($socio->comprobanteDomicilioPdf);

        // Return the response as a PDF
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $socio->nombre . '_comprobanteDomicilio' . '"');
    }

    public function showActaNacimiento($id)
    {
        // Find the document by its ID
        $socio = Socio::findOrFail($id);

        // Decode the base64 encoded content
        $pdfContent = base64_decode($socio->actaNacimientoPdf);

        // Return the response as a PDF
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $socio->nombre . '_actaNacimiento' . '"');
    }

    public function showIne($id)
    {
        // Find the document by its ID
        $socio = Socio::findOrFail($id);

        // Decode the base64 encoded content
        $pdfContent = base64_decode($socio->inePdf);

        // Return the response as a PDF
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $socio->nombre . '_ine' . '"');
    }

    public function showActaMatrimonio($id)
    {
        // Find the document by its ID
        $socio = Socio::findOrFail($id);

        // Decode the base64 encoded content
        $pdfContent = base64_decode($socio->actaMatrimonioPdf);

        // Return the response as a PDF
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $socio->nombre . '_actaMatrimonio' . '"');
    }

    public function showConstanciaSituacionFiscal($id)
    {
        // Find the document by its ID
        $socio = Socio::findOrFail($id);

        // Decode the base64 encoded content
        $pdfContent = base64_decode($socio->constanciaSituacionFiscalPdf);

        // Return the response as a PDF
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $socio->nombre . '_constanciaSituacionFiscal' . '"');
    }

    public function eliminarSocio(Request $request) 
    {
        $idSocio = $request->idSocio;
        $idUser = $request->idUser;
        $socio = Socio::with('empresa.user')->find($idSocio);
        try {
            if ($socio->empresa->user->id == $idUser) {
                $socioNombre = $socio->nombre;
                $socio->delete();
                return back()->with('success', 'Se eliminó correctamente el socio ' . $socioNombre);
            }
            else {
                return back()->withErrors(['custom_error' => 'No se pudo borrar al socio porque esa empresa no la registraste tú.']);
            }
        } catch (\Throwable $th) {
            dd($th);
            return back()->withErrors(['custom_error' => 'No se pudo borrar al socio por alguna razón.']);
        }
    }
}
