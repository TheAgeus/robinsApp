<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Socio;


class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $socioId = $request->idEmpresa;
        $socio = Socio::find($socioId); 
        // Send the email
        Mail::to('agustin.aguilar@reor-corporativo.com')->send(new SendMail($socio->comprobanteDomicilioPdf));

        return "Email with BLOB attachments sent successfully!";
    }
}
